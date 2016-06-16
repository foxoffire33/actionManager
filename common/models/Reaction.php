<?php

namespace common\models;

use common\components\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "reaction".
 *
 * @property integer $id
 * @property integer $action_id
 * @property string $ip
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_at
 */
class Reaction extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['action_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'deleted_at'], 'integer'],
            [['ip'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'action_id' => 'Action ID',
            'ip' => 'Ip',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'deleted_at' => 'Deleted At',
        ];
    }

    public function getActionFieldsValue()
    {
        return $this->hasMany(ActionFieldsValue::className(), ['reaction_id' => 'id'])->orderBy('action_field_id');
    }

}
