<?php
namespace frontend\controllers;

use common\models\User;
use frontend\components\web\Controller;
use frontend\models\forms\SignupForm;
use Yii;


class UserController extends Controller
{
    public function actionRegister()
    {

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $mail = Yii::$app->mailer->compose('welcome', ['model' => $model])
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->params['supportName']])
                ->setTo([$model->email => $model->name])
                ->setSubject(Yii::t('signupForm', 'Activation account'));
            $this->redirect(['/user/register']);
        }

        return $this->render('register', ['model' => $model]);
    }

   /* public function actionActivate($token)
    {
      //  if(($model = User::findOne(['auth_token' => $token,'status' => User::STATUS_ACTIVE])))
    }

    public function actionUpdate()
    {

    }

    public function actionPasswordResetRequest()
    {

    }

    public function actionPasswordReset()
    {

    }*/

}