<?php

namespace frontend\modules\user\controllers;

use backend\components\web\Controller;
use Yii;
use yii\filters\AccessControl;
use frontend\modules\user\models\SignupForm;
use frontend\modules\user\Module;

class RegistrationController extends Controller
{
    /** @var string */
    public $defaultAction = 'register';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['register'],
                        'allow' => true,
                    ],
                ],
            ],
        ];
    }

    public function actionRegister()
    {

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $mail = Yii::$app->mailer->compose('welcome', ['model' => $model])
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->params['supportName']])
                ->setTo([$model->email => $model->name])
                ->setSubject(Module::t('signupForm', 'Account created'))
                ->send();
            Yii::$app->session->setFlash('success', Module::t('signupForm', 'We send a password to {email}', ['email' => $model->email]));
            return $this->redirect(['/user/registration']);
        }

        return $this->render('register', ['model' => $model]);
    }
}