<?php

namespace common\models;

use Yii;
//use yii\db\ActiveRecord;
use common\components\db\ActiveRecord;

/**
 * This is the model class for table "organization".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $postal
 * @property string $city
 * @property string $logo
 * @property resource $description
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_at
 *
 * @property Action[] $actions
 * @property User $updatedBy
 * @property User $createdBy
 */
class Organization extends ActiveRecord
{

    public $logo_virtual;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organization';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address', 'city', 'organization_user'], 'required'],
            [['description'], 'string'],
            [['created_at', 'updated_at', 'created_by', 'updated_by', 'deleted_at'], 'integer'],
            [['name', 'address', 'city', 'logo'], 'string', 'max' => 128],
            [['postal'], 'string', 'max' => 6],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            ['logo','file']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('organization', 'ID'),
            'name' => Yii::t('organization', 'Name'),
            'address' => Yii::t('organization', 'Address'),
            'postal' => Yii::t('organization', 'Postal'),
            'city' => Yii::t('organization', 'City'),
            'logo' => Yii::t('organization', 'Logo'),
            'description' => Yii::t('organization', 'Description'),
            'created_at' => Yii::t('organization', 'Created At'),
            'updated_at' => Yii::t('organization', 'Updated At'),
            'created_by' => Yii::t('organization', 'Created By'),
            'updated_by' => Yii::t('organization', 'Updated By'),
            'deleted_at' => Yii::t('organization', 'deleted_at'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActions()
    {
        return $this->hasMany(Action::className(), ['organization_id' => 'id']);
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
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getOrganizationUser(){
        return $this->hasOne(User::className(),['id' => 'organization_user']);
    }

    public function getLogoBase64(){
        $image = Yii::getAlias('@uploadPath').'/'.$this->logo;
        return 'data: '.mime_content_type($image).';base64,'.base64_encode(file_get_contents($image));
    }
}
