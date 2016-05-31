<?php
namespace backend\modules\user\models;

use backend\modules\user\Module;
use Yii;
use yii\db\ActiveRecord;

/**
 * Role model
 *
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $rule_name
 * @property string $data
 * @property integer $created_at
 * @property integer $updated_at
 */
class Role extends ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			\yii\behaviors\TimestampBehavior::className(),
		];
	}

	/**
	 * @return string
	 */
	public function getId()
	{
		return $this->name;
	}

	/**
	 * @return string the table name
	 */
	public static function tableName()
	{
		return 'auth_item';
	}


	/**
	 * @return array
	 */
	public function rules()
	{
		return [
			[['name', 'type', 'description'], 'required'],
			[['name'], 'unique'],
			[['created_at', 'updated_at'], 'integer'],

			[['rule_name', 'data', 'created_at', 'updated_at'], 'safe']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'name'        => Module::t('role', 'Name'),
			'type'        => Module::t('role', 'Type'),
			'description' => Module::t('role', 'Description'),
			'rule_name'   => Module::t('role', 'Rule Name'),
			'data'        => Module::t('role', 'Data'),
			'created_at'  => Module::t('role', 'Created At'),
			'updated_at'  => Module::t('role', 'Updated At'),
		];
	}


}
