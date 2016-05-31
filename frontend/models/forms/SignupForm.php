<?php
namespace frontend\models\forms;

use common\models\Organization;
use common\models\User;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class SignupForm extends Model
{

    public $name;
    public $address;
    public $city;
    public $logo;
    public $description;
    //user
    public $username;
    public $email;
    public $email_repeat;
    public $password;
    public $password_repeat;
    //for redirect
    public $organization_id;

    private $imageUploadDir;

    public function init()
    {
        $this->imageUploadDir = realpath(dirname(__FILE__) . '/../..//uploads/');
    }

    public function rules()
    {
        return [
            [['username'], 'required'],
            //email validatetion
            [['email'], 'required'],
            ['email', 'email'],
            //unique
            ['email', 'unique', 'targetClass' => User::className(), 'targetAttribute' => 'email'],
            ['username', 'unique', 'targetClass' => User::className(), 'targetAttribute' => 'username'],
            ['name', 'unique', 'targetClass' => Organization::className(), 'targetAttribute' => 'name'],
            //safe
            [['description'], 'safe'],
            //save logo
            ['logo', 'file','extensions' => ['jpg','jpeg','png']]
        ];
    }

    public function save()
    {
        if ($this->validate()) {
            $organization = new Organization();
            $user = new User(['scenario' => User::SCENARIO_REGISTER]);

            $organization->setAttributes([
                'name' => $this->name,
                'address' => $this->address,
                'city' => $this->city,
                'description' => $this->description
            ]);
            //save uploaded file
            $this->logo = UploadedFile::getInstance($this, 'logo');
            $saveName = $this->getnewLogoName(rand(1000, 9000), $this->logo->extension);
            if ($this->logo->saveAs($this->imageUploadDir . $saveName)) {
                $organization->logo = $saveName;
            }
            //set user fields
            $user->setAttributes([
                'username' => $this->username,
                'email' => $this->email,
                'password_hash' => Yii::$app->security->generatePasswordHash($this->password),
                'auth_key' => Yii::$app->security->generateRandomKey(30)
            ]);

            if ($user->save()) {
                $organization->setAttribute('organization_user', $user->id);
                return $organization->save();
            }
        }
        return false;
    }

    public function afterValidate()
    {
        $this->password = Yii::$app->security->generateRandomKey(8);
        parent::afterValidate();
    }

    private function getnewLogoName($name, $extension)
    {
        if (file_exists($this->imageUploadDir . $name . '.' . $extension)) {
            $this->getnewLogoName(rand(1000, 9000), $extension);
        }
        return $this->imageUploadDir . $name . '.' . $extension;
    }

    public function getAttributeLabels()
    {
        return [];
    }

}