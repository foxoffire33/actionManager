<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "action_fields_value".
 *
 * @property integer $reaction_id
 * @property integer $action_field_id
 * @property string $value
 * @property string $ip
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 *
 * @property ActionFields $actionField
 */
class ActionFieldsValue extends \common\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'action_fields_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value'], 'string'],
            [['ip'], 'string', 'max' => 36],
            [['reaction_id'], 'unique'],
          //  [['action_field_id'], 'exist', 'skipOnError' => true, 'targetClass' => ActionFields::className(), 'targetAttribute' => ['action_field_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'reaction_id' => Yii::t('actionFieldsValue', 'Reaction ID'),
            'action_field_id' => Yii::t('actionFieldsValue', 'Action Field ID'),
            'value' => Yii::t('actionFieldsValue', 'Value'),
            'ip' => Yii::t('actionFieldsValue', 'Ip'),
            'created_at' => Yii::t('actionFieldsValue', 'Created At'),
            'updated_at' => Yii::t('actionFieldsValue', 'Updated At'),
            'deleted_at' => Yii::t('actionFieldsValue', 'deleted_at'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActionField()
    {
        return $this->hasOne(ActionFields::className(), ['id' => 'action_field_id']);
    }
}
