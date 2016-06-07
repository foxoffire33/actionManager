<?php

namespace common\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "token".
 *
 * @property integer $user_id
 * @property string $code
 * @property integer $type
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 */
class Token extends \yii\db\ActiveRecord
{
    const TYPE_FACEBOOK = 0;
    const TYPE_TWITTER = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'token';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'code'], 'required'],
            [['user_id', 'type', 'created_at', 'updated_at'], 'integer'],
            [['code'], 'string', 'max' => 400],
            [['user_id', 'code', 'type'], 'unique', 'targetAttribute' => ['user_id', 'code', 'type'], 'message' => 'The combination of User ID, Code and Type has already been taken.'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'code' => 'Code',
            'type' => 'Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
