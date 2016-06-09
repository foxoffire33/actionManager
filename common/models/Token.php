<?php

namespace common\models;

use common\components\db\ActiveRecord;
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
class Token extends ActiveRecord
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
            [['user_id', 'token'], 'required'],
            [['user_id', 'type', 'created_at', 'updated_at'], 'integer'],
            [['token'], 'string', 'max' => 400],
            [['user_id', 'token', 'type'], 'unique', 'targetAttribute' => ['user_id', 'token', 'type'], 'message' => 'The combination of User ID, Token and Type has already been taken.'],
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
            'Token' => 'Token',
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
