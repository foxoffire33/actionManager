<?php
namespace frontend\modules\user\models\forms;

use frontend\modules\user\Module;
use common\models\User;
use Yii;
use \yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
	/** @var */
	public $email;
	/** @var */
	public $password;
	/** @var bool */
	public $rememberMe = true;
	/** @var bool */
	private $_user = false;


	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['email', 'password'], 'required'], // username and password are both required
			['rememberMe', 'boolean'], // rememberMe must be a boolean value
			['password', 'validatePassword'], // password is validated by validatePassword()
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
		if (!$this->hasErrors()) {
			$user = $this->getUser();
			if (!$user || !$user->validatePassword($this->password)) {
				$this->addError($attribute, Module::t('user', 'Incorrect email or password.'));
			}
		}
	}

	/**
	 * Logs in a user using the provided email and password.
	 *
	 * @return boolean whether the user is logged in successfully
	 */
	public function login()
	{
		if ($this->validate()) {
			return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
		} else {
			return false;
		}
	}

	/**
	 * Finds user by [[username]]
	 *
	 * @return User|null
	 */
	public function getUser()
	{
		if ($this->_user === false) {
			$this->_user = User::findByEmail($this->email);
		}

		return $this->_user;
	}

	/**
	 * @return array
	 */
	public function attributeLabels()
	{
		return [
			'email'   => Module::t('login', 'Email'),
			'password'   => Module::t('login', 'Password'),
			'rememberMe' => Module::t('login', 'Remember Me'),
		];
	}
}
