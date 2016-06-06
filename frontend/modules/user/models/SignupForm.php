<?php
namespace frontend\modules\user\models;

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
    public $password;
    public $email;
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
            [['name', 'address', 'city', 'username'], 'required'],
            //email validatetion
            [['email'], 'required'],
            ['email', 'email'],
            //unique
            ['email', 'unique', 'targetClass' => User::className(), 'targetAttribute' => 'email'],
            ['username', 'unique', 'targetClass' => User::className(), 'targetAttribute' => 'username'],
            ['name', 'unique', 'targetClass' => Organization::className(), 'targetAttribute' => 'name'],
            //safe
            [['description','logo'], 'safe'],
            //save logo
            ['logo', 'file', 'extensions' => ['jpg', 'jpeg', 'png'],'skipOnEmpty' => false],
        ];
    }

    public function beforeValidate()
    {
        $this->logo = UploadedFile::getInstance($this, 'logo');
        return parent::beforeValidate();
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
            $saveName = $this->getnewLogoName(rand(1000, 9000), $this->logo->extension);
            if ($this->logo->saveAs(Yii::getAlias('@uploadPath') . '/' . $saveName)) {
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
                //add to rule member
                 $auth = Yii::$app->authManager;
                $authorRole = $auth->getRole('member');
                $auth->assign($authorRole, $user->getId());
                //set user id by organization
                $organization->setAttribute('organization_user', $user->id);
                return $organization->save();
            }
        }
        return false;
    }

    private function getnewLogoName($name, $extension)
    {
        if (file_exists($this->imageUploadDir . $name . '.' . $extension)) {
            $this->getnewLogoName(rand(1000, 9000), $extension);
        }
        return $this->imageUploadDir . $name . '.' . $extension;
    }

    public function afterValidate()
    {
        $this->password = Yii::$app->security->generateRandomString(8);
        parent::afterValidate();
    }

    public function getAttributeLabels()
    {
        return [];
    }

}