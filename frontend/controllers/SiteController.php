<?php
namespace frontend\controllers;

use common\models\Token;
use frontend\components\authClient\TokenHelper;
use frontend\components\facebook\Auth;
use frontend\components\twitter\TwitterAuth;
use frontend\components\web\AuthClientHelper;
use frontend\components\web\Controller;
use frontend\models\forms\ContactForm;
use Yii;
use frontend\components\authClient\AuthHandler;
use yii\base\Exception;

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

    public function onAuthSuccess($client){
      //  $facebook = TokenHelper::SetDBToken($client);
        var_dump($client);exit;
      //  var_dump($facebook->accessToken->isValid);
    }

    public function actionFacebook(){
        $facebookAuth = (new AuthHandler(Yii::$app->authClientCollection->clients['facebook']));
        var_dump($facebookAuth->getUserAttributes());
    }

    public function actionTwitter(){
        $handler = new AuthHandler(Yii::$app->authClientCollection->clients['twitter']);
        var_dump($handler->getUserAttributes());
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
