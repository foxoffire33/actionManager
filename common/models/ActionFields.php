<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "action_fields".
 *
 * @property integer $id
 * @property integer $action_id
 * @property string $label
 * @property integer $required
 * @property integer $type
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_at
 *
 * @property Action $action
 * @property User $createdBy
 * @property User $updatedBy
 * @property ActionFieldsValue[] $actionFieldsValues
 */
class ActionFields extends \common\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'action_fields';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['action_id', 'required', 'type', 'created_at', 'updated_at', 'created_by', 'updated_by', 'deleted_at'], 'integer'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'required'],
            [['label'], 'string', 'max' => 128],
            [['action_id'], 'exist', 'skipOnError' => true, 'targetClass' => Action::className(), 'targetAttribute' => ['action_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('action', 'ID'),
            'action_id' => Yii::t('action', 'Action ID'),
            'label' => Yii::t('action', 'Label'),
            'required' => Yii::t('action', 'Required'),
            'type' => Yii::t('action', 'Type'),
            'created_at' => Yii::t('action', 'Created At'),
            'updated_at' => Yii::t('action', 'Updated At'),
            'created_by' => Yii::t('action', 'Created By'),
            'updated_by' => Yii::t('action', 'Updated By'),
            'deleted_at' => Yii::t('action', 'deleted_at'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAction()
    {
        return $this->hasOne(Action::className(), ['id' => 'action_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActionFieldsValues()
    {
        return $this->hasMany(ActionFieldsValue::className(), ['action_field_id' => 'id']);
    }
}
