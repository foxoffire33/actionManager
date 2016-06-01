<?php
namespace frontend\modules\user\controllers;

use frontend\components\web\Controller;
use Yii;

class LogoutController extends Controller
{
    public $defaultAction = 'logout';


    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}