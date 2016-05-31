<?php
namespace backend\modules\user\models\forms;

use backend\modules\user\Module;
use backend\modules\user\models\User;
use Yii;
use \yii\base\Model;

/**
 * RegistrationForm
 */
class RegistrationForm extends Model
{
	/** @var String */
	public $email;
	/** @var String */
	public $username;
	/** @var String */
	public $password;
	/** @var String */
	public $repeat_password;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['email', 'username', 'password', 'repeat_password'], 'required'],
			[['email'], 'email'],
			[['username', 'password'], 'string', 'min' => 6],
			['repeat_password', 'compare', 'compareAttribute' => 'password', 'operator' => '==='],
		];
	}

	/**
	 * Validates the password.
	 * This method serves as the inline validation for password.
	 *
	 * @param string $attribute the attribute currently being validated
	 * @param array $params the additional name-value pairs given in the rule
	 */
	public function validatePassword($attribute, $params)
	{
		var_dump($this->password);
		// TODO misschien letters+cijfers? Extra randvoorwaarden?
	}

	/**
	 * Save the user and send an email with the activation key
	 * @return bool
	 */
	public function register()
	{
		// Create user
		$user = new User([
			'username' => $this->username,
			'email'    => $this->email,
			'status'   => User::STATUS_deleted_at,
			'roles'    => ['member']
		]);

		$user->setPassword($this->password);
		$user->generateAuthKey();
		$user->save();

		return \Yii::$app->mailer->compose('@backend/modules/user/views/mail/registration', ['user' => $user])
			->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name])
			->setTo($this->email)
			->setSubject(Module::t('registration', 'Account activation for {email}', ['name' => \Yii::$app->name]))
			->send();
	}

	/**
	 * @return array
	 */
	public function attributeLabels()
	{
		return [
			'email'           => Module::t('registration', 'Email'),
			'username'        => Module::t('registration', 'Username'),
			'password'        => Module::t('registration', 'Password'),
			'repeat_password' => Module::t('registration', 'Repeat Password'),
		];
	}
}
