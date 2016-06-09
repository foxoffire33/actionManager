<?php

namespace common\models;

use common\components\helpers\FileHelper;
use Yii;
use yii\web\UploadedFile;

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
    const SCENARIO_UPDATE = 'update';

    public $image_virtual;
    public $image_facebook_virtual;
    public $image_twitter_virtual;
    //options
    public $post_on_facebook;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'action';
    }

    public function beforeValidate()
    {
        if (!is_null(($image = UploadedFile::getInstance($this, 'image_virtual')))) {
            $this->image_virtual = $image;
        }
        if (!is_null(($image_facebook = UploadedFile::getInstance($this, 'image_facebook_virtual')))) {
            $this->image_facebook_virtual = $image_facebook;
        }
        if (!is_null(($image_twitter = UploadedFile::getInstance($this, 'image_twitter_virtual')))) {
            $this->image_twitter_virtual = $image_twitter;
        }
        return parent::beforeValidate();
    }

    public function beforeSave($insert)
    {
        if (is_a($this->image_virtual, UploadedFile::className())) {
            if (!empty($this->image)) {
                unlink(Yii::getAlias('@uploadPath') . '/' . $this->image);
            }
            $this->image = $this->upload($this->image_virtual);
        }
        if (is_a($this->image_facebook_virtual, UploadedFile::className())) {
            if (!empty($this->image_facebook)) {
                unlink(Yii::getAlias('@uploadPath') . '/' . $this->image_facebook);
            }
            $this->image_facebook = $this->upload($this->image_facebook_virtual);

        }
        if (is_a($this->image_twitter_virtual, UploadedFile::className())) {
            if (!empty($this->image_twitter)) {
                unlink(Yii::getAlias('@uploadPath') . '/' . $this->image_twitter);
            }
            $this->image_twitter = $this->upload($this->image_twitter_virtual);
        }
        return parent::beforeSave($insert);
    }

    public function upload($imageFile)
    {
        $imageRedom = FileHelper::redomName($imageFile->baseName, $imageFile->extension);
        $imageFile->saveAs($imageRedom);
        return array_pop((array_slice(explode('/', $imageRedom), -1)));
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['organization_id', 'default', 'value' => Organization::findOne(['organization_user' => Yii::$app->user->id])->id],
            [['name', 'intro', 'description', 'description_twitter'], 'required'],
            [['description', 'description_facebook', 'description_twitter'], 'string'],
            [['name', 'image', 'image_facebook', 'image_twitter'], 'string', 'max' => 128],
            [['intro'], 'string', 'max' => 255],
            [['post_on_facebook', 'post_on_twitter'], 'safe'],
            [['image_virtual', 'image_facebook_virtual', 'image_twitter_virtual'], 'required', 'except' => self::SCENARIO_UPDATE],
            [['image_virtual', 'image_facebook_virtual', 'image_twitter_virtual'], 'file', 'extensions' => ['jpg', 'jpeg', 'png']],
            [['image_virtual', 'image_facebook_virtual', 'image_twitter_virtual'], 'file', 'skipOnEmpty' => true, 'on' => self::SCENARIO_UPDATE]
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
