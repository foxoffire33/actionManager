<?php
namespace backend\modules\user\models\forms;

use backend\modules\user\models\User;
use yii\base\Model;
use backend\modules\user\Module;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
	/** @var */
	public $email;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['email', 'email'],
			['email', 'exist',
				'targetClass' => '\common\models\User',
				'filter'      => ['status' => User::STATUS_ACTIVE],
				'message'     => Module::t('reset', 'There is no user with such email.')
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'email' => Module::t('reset', 'Email'),
		];
	}

	/**
	 * Sends an email with a link, for resetting the password.
	 *
	 * @return boolean whether the email was send
	 */
	public function sendEmail()
	{
		/* @var $user User */
		$user = User::findOne([
			'status' => User::STATUS_ACTIVE,
			'email'  => $this->email,
		]);

		if ($user) {
			if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
				$user->generatePasswordResetToken();
			}

			if ($user->save()) {
				return \Yii::$app->mailer->compose('@backend/modules/user/views/mail/reset', ['user' => $user])
					->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name])
					->setTo($this->email)
					->setSubject(Module::t('reset', 'Password reset for {name}', ['name' => \Yii::$app->name]))
					->send();
			}
		}

		return false;
	}
}
