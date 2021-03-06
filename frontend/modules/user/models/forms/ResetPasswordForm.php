<?php
namespace frontend\modules\user\models\forms;

use backend\modules\user\models\User;
use frontend\modules\user\Module;
use yii\base\InvalidParamException;
use yii\base\Model;
use Yii;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
	/** @var */
	public $password;

	/** @var \common\models\User */
	private $_user;

	/**
	 * Creates a form model given a token.
	 *
	 * @param  string $token
	 * @param  array $config name-value pairs that will be used to initialize the object properties
	 * @throws \yii\base\InvalidParamException if token is empty or not valid
	 */
	public function __construct($token, $config = [])
	{
		if (empty($token) || !is_string($token)) {
			throw new InvalidParamException(Module::t('reset', 'Password reset token cannot be blank.'));
		}
		$this->_user = User::findByPasswordResetToken($token);
		if (!$this->_user) {
			throw new InvalidParamException(Module::t('reset', 'Wrong password reset token.'));
		}
		parent::__construct($config);
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['password', 'required'],
			['password', 'string', 'min' => 6],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'password' => Module::t('reset', 'Password'),
		];
	}

	/**
	 * Resets password.
	 *
	 * @return boolean if password was reset.
	 */
	public function resetPassword()
	{
		$user = $this->_user;
		$user->setPassword($this->password);
		$user->removePasswordResetToken();

		return $user->save(false);
	}
}
