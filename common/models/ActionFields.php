<?php

namespace common\models;

use Yii;
use yii\helpers\Inflector;

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
    const TYPE_TEXT = 0;
    const TYPE_CHECKBOX = 1;
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
            [['name', 'label'], 'required'],
            [['label','name'], 'string', 'max' => 128],
            [['required', 'type'], 'default', 'value' => false]
            //[['action_id'], 'exist', 'skipOnError' => true, 'targetClass' => Action::className(), 'targetAttribute' => ['action_id' => 'id']],
        ];
    }

    public function beforeSave($insert)
    {
        if (!is_null($this->label)) {
            $this->label = Inflector::variablize($this->label);
        }
        return parent::beforeSave($insert);
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
        return $this->hasMany(ActionFieldsValue::className(), ['action_field_id' => 'id'])->orderBy('reaction_id');
    }
}
