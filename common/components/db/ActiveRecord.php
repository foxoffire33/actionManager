<?php
namespace common\components\db;

/**
 * Class ActiveRecord
 * @package common\components\db
 */
class ActiveRecord extends \yii\db\ActiveRecord
{
	const DELETE_ATTRIBUTE = 'deleted_at';

	/**
	 * Fix the decimals, used with prices and hours
	 * @param $attribute
	 * @return mixed
	 */
	protected function fixDecimal($attribute)
	{
		return str_replace(",", ".", $attribute);
	}

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			\yii\behaviors\TimestampBehavior::className(),
			\common\components\behavior\CreatedUpdatedBehavior::className(),
			'softDeleteBehavior' => [
				'class'     => \common\components\behavior\SoftDeleteBehavior::className(),
				'attribute' => self::DELETE_ATTRIBUTE,
			],

		];
	}

	/**
	 * Override default find() method so we exclude the deleted_at models
	 * @return $this
	 */
	public static function find()
	{
		return parent::find()->where([self::tableName() . '.' . self::DELETE_ATTRIBUTE => null]);
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(), [
			'id'                   => \Yii::t('common', 'ID'),
			'created_by'           => \Yii::t('common', 'Created By'),
			'updated_by'           => \Yii::t('common', 'Updated By'),
			'created_at'           => \Yii::t('common', 'Created At'),
			'updated_at'           => \Yii::t('common', 'Updated At'),
			self::DELETE_ATTRIBUTE => \Yii::t('common', 'deleted_at At'),
		]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUpdatedBy()
	{
		return $this->hasOne(\common\models\User::className(), ['id' => 'updated_by']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCreatedBy()
	{
		return $this->hasOne(\common\models\User::className(), ['id' => 'created_by']);
	}

	/**
	 * @param $date
	 * @return bool|string
	 */
	public function fixDate($date)
	{
		return date('Y-m-d', strtotime($date));
	}

	/**
	 * Creates a new model or returns the found one if present
	 * @param $attributes
	 * @return null|static
	 */
	public static function findOrNew($attributes)
	{
		$model = self::findOne($attributes);
		if (is_null($model)) {
			$class = self::className();
			$model = new $class($attributes);
		}

		return $model;

	}

}