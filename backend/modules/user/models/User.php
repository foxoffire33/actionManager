<?php
namespace backend\modules\user\models;

use backend\modules\user\Module;
use Yii;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends \common\models\User
{
	/** @var */
	public $repeat_password;
	/** @var */
	public $enter_password;
	/** @var */
	public $roles;

	/**
	 * @param bool $insert
	 * @param array $changedAttributes
	 * @throws \yii\db\Exception
	 */
	public function afterSave($insert, $changedAttributes)
	{
		parent::afterSave($insert, $changedAttributes);

		if (!empty($this->roles)) {
			\Yii::$app->db->createCommand()->delete('auth_assignment', 'user_id = ' . (int)$this->id)->execute(); //Delete existing value
			foreach ($this->roles as $selected_role) { //Write new values
				$role = Yii::$app->authManager->getRole($selected_role);
				Yii::$app->authManager->assign($role, $this->id);
			}
		}
	}

	/**
	 * @return array
	 */
	public function rules()
	{
		return [
			['username', 'required'],
			['username', 'trim'],
			['email', 'email'],
			[['username', 'email'], 'unique'],

			['enter_password', 'required', 'on' => ['set_password', 'changePassword']],
			['enter_password', 'string', 'min' => 8, 'max' => 255, 'on' => ['set_password', 'changePassword']],

			['repeat_password', 'required', 'on' => ['set_password', 'changePassword']],
			['repeat_password', 'compare', 'compareAttribute' => 'enter_password'],

			[['enter_password', 'repeat_password'], 'safe', 'on' => 'update_user'],

			[['roles'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id'              => Module::t('user', 'ID'),
			'username'        => Module::t('user', 'Username'),
			'email'           => Module::t('user', 'E-mail'),
			'password'        => Module::t('user', 'Password'),
			'enter_password'  => Module::t('user', 'Enter Password'),
			'repeat_password' => Module::t('user', 'Repeat Password'),
			'roles'           => Module::t('user', 'Roles'),
		];
	}


}
