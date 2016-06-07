<?php
namespace frontend\controllers;

use common\models\Token;
use frontend\components\web\AuthClientHelper;
use frontend\components\web\Controller;
use frontend\models\forms\ContactForm;
use Yii;
use yii\web\UnauthorizedHttpException;

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
        $model = Token::find()->where(['user_id' => Yii::$app->user->id, 'type' => (Yii::$app->request->get('authclient') == 'facebook' ? Token::TYPE_FACEBOOK : Token::TYPE_TWITTER)])->one();
        if (is_null($model)) {
            $model = new Token();
        }
        if (Yii::$app->request->get('authclient') == 'facebook') {
            $model->access_token = $client->accessToken->token;
            $model->expires = $client->accessToken->expireDuration;
            $model->code = Yii::$app->request->get('code');
            $model->user_id = Yii::$app->user->id;
            $model->type = Token::TYPE_FACEBOOK;
        } else {
            $model->access_token = $client->accessToken->token;
            $model->expires = $client->accessToken->expireDuration;
            $model->code = Yii::$app->request->get('oauth_token');
            $model->user_id = Yii::$app->user->id;
            $model->type = Token::TYPE_TWITTER;
        }
        if ($model->save()) {
            return $this->render('connected', ['model' => $model]);
        }
        throw new UnauthorizedHttpException();
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
    public function actionContact()
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
    public function actionAbout()
    {
        return $this->render('about');
    }
}
