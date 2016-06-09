<?php
namespace frontend\controllers;

use Abraham\TwitterOAuth\TwitterOAuth;
use common\models\Token;
use frontend\components\facebook\Auth;
use frontend\components\twitter\TwitterAuth;
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

    public function actionTwitter($oauth_token, $oauth_verifier)
    {
        $twitter = new TwitterAuth();
        $request_token = [];
        $request_token['oauth_token'] = $_SESSION['oauth_token'];
        $request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];

        $connection = new TwitterOAuth('E6QFE8kcJmbPaGdFAl1jEhk4Z', 'mXPHgFVOM7dGBXDgxFHdJdI8TiLJeCcnc1G8E9J52CMHqaeBSh', $request_token['oauth_token'], $request_token['oauth_token_secret']);
        $access_token = $connection->oauth("oauth/access_token", ["oauth_verifier" => $oauth_verifier]);
        $_SESSION['access_token'] = $access_token;

        $access_token = $_SESSION['access_token'];
        $connection = new TwitterOAuth('E6QFE8kcJmbPaGdFAl1jEhk4Z', 'mXPHgFVOM7dGBXDgxFHdJdI8TiLJeCcnc1G8E9J52CMHqaeBSh', $access_token['oauth_token'], $access_token['oauth_token_secret']);

        var_dump($connection->post("statuses/update", ["status" => "hello world"]));
    }

    public function actionFacebook($code)
    {
        $facebook = new Auth();
        //firsttime login
        if (!is_null(($access_token = $facebook->getAccessToken()))) {
            if (empty(($model = \Yii::$app->user->identity->token))) {
                $model = new Token();
            } else {
                $model->user_id = \Yii::$app->user->id;
                $model->type = 0;
            }
            $model->token = $access_token->getValue();
            $model->save();
        }
        return $this->render('connected');
    }

    public function onAuthSuccess($client)
    {
        $model = Token::find()->where(['user_id' => Yii::$app->user->id, 'type' => (Yii::$app->request->get('authclient') == 'facebook' ? Token::TYPE_FACEBOOK : Token::TYPE_TWITTER)])->one();
        if (is_null($model)) {
            $model = new Token();
        }
        $model->user_id = Yii::$app->user->id;
        $model->token = $client->accessToken->token;
        $model->type = (Yii::$app->request->get('authclient') == 'facebook' ? Token::TYPE_FACEBOOK : Token::TYPE_TWITTER);
        if ($model->save()) {
            return $this->render('connected', ['model' => $model]);
        }
        throw new UnauthorizedHttpException();
    }

    public function actionLinkAccount()
    {
        $facebook = new \frontend\components\facebook\Auth();
        $twitter = new TwitterAuth();
        return $this->render('link-account', ['facebookUrl' => $facebook->getLoginUrl(), 'twitterUrl' => $twitter->getLoginUrl()]);
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
