<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "action".
 *
 * @property integer $id
 * @property integer $organization_id
 * @property string $name
 * @property string $intro
 * @property string $description
 * @property string $image
 * @property string $image_facebook
 * @property string $description_facebook
 * @property string $image_twitter
 * @property string $description_twitter
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_at
 *
 * @property Organization $organization
 * @property User $createdBy
 * @property User $updatedBy
 * @property ActionFields[] $actionFields
 */
class Action extends \common\components\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'action';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['organization_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'deleted_at'], 'integer'],
            [['name', 'intro', 'description', 'image', 'image_facebook', 'description_facebook', 'image_twitter', 'description_twitter', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'required'],
            [['description', 'description_facebook', 'description_twitter'], 'string'],
            [['name', 'image', 'image_facebook', 'image_twitter'], 'string', 'max' => 128],
            [['intro'], 'string', 'max' => 255],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['organization_id' => 'id']],
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
            'organization_id' => Yii::t('action', 'Organization ID'),
            'name' => Yii::t('action', 'Name'),
            'intro' => Yii::t('action', 'Intro'),
            'description' => Yii::t('action', 'Description'),
            'image' => Yii::t('action', 'Image'),
            'image_facebook' => Yii::t('action', 'Image Facebook'),
            'description_facebook' => Yii::t('action', 'Description Facebook'),
            'image_twitter' => Yii::t('action', 'Image Twitter'),
            'description_twitter' => Yii::t('action', 'Description Twitter'),
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
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
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
    public function getActionFields()
    {
        return $this->hasMany(ActionFields::className(), ['action_id' => 'id']);
    }
}
