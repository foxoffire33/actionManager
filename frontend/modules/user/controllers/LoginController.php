<?php
namespace frontend\modules\user\controllers;

use backend\components\web\Controller;
use frontend\modules\user\models\forms\LoginForm;
use Yii;
use yii\filters\AccessControl;

class LoginController extends Controller
{
    /** @var string */
    public $defaultAction = 'login';
    /** @var string */
    public $layout = '@frontend/views/layouts/login_main';

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
                        'actions' => ['login'],
                        'allow' => true,
                    ],
                ],
            ],
        ];
    }

    /**
     * Login action
     * @return string|\yii\web\Response
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['/action']);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
}