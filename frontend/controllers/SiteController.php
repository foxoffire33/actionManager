<?php
namespace frontend\controllers;

use frontend\components\authClient\AuthHandler;
use frontend\components\authClient\TokenHelper;
use frontend\components\web\AuthClientHelper;
use frontend\components\web\Controller;
use frontend\models\forms\ContactForm;
use Yii;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
        ];
    }

    public function onAuthSuccess($client)
    {
        (new AuthHandler($client));
    }

    public function actionFacebook()
    {
        $facebookAuth = (new AuthHandler(Yii::$app->authClientCollection->clients['facebook']));
        var_dump($facebookAuth->api('me/feed', ['message' => 'een test met yii2 auth client' . rand(0, 10)]));
    }

    public function actionTwitter()
    {
        $handler = new AuthHandler(Yii::$app->authClientCollection->clients['twitter']);
        var_dump($handler->api('statuses/update.json', ['status' => 'een test met yii2 auth client' . rand(0, 10)]));
    }

    public function actionLinkAccount()
    {
        return $this->render('link-account');
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public
    function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(\Yii::$app->params['adminEmail'])) {
                \Yii::$app->session->setFlash('success', \Yii::t('contact', 'Thank you for contacting us. We will respond to you as soon as possible.'));
            } else {
                \Yii::$app->session->setFlash('error', \Yii::t('contact', 'There was an error sending email.'));
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public
    function actionAbout()
    {
        return $this->render('about');
    }
}
