<?php
namespace frontend\components\authClient;

use common\models\Token;
use Yii;
use yii\authclient\ClientInterface;
use yii\authclient\clients\Facebook;
use yii\authclient\OAuthToken;
use yii\base\NotSupportedException;
use yii\helpers\Url;
use yii\web\UnauthorizedHttpException;
use yii\helpers\Html;

/**
 * AuthHandler handles successful authentification via Yii auth component
 */
class AuthHandler
{

    const OAUTH_METHOD_POST = 'POST';
    const OAUTH_METHOD_GET = 'GET';
    /**
     * @var ClientInterface
     */
    private $client;
    private $tokenModel;

    public function __construct($clientName)
    {
        if (($client = $this->checkClients($clientName)) !== false || is_object(($client = $clientName))) {
            $this->client = $client;
            $this->tokenModel = Token::findOne(['user_id' => Yii::$app->user->id, 'type' => (is_a($this->client, Facebook::className()) ? Token::TYPE_FACEBOOK : Token::TYPE_TWITTER)]);
            if (!is_null(($this->tokenModel))) {
                $this->client->setAccessToken(new OAuthToken(['token' => $this->tokenModel->token, 'tokenSecret' => $this->tokenModel->token_secret]));
            } else {
                $this->tokenModel = new Token();
                $this->tokenModel->user_id = \Yii::$app->user->id;
                $this->tokenModel->type = (is_a($this->client, Facebook::className()) ? Token::TYPE_FACEBOOK : Token::TYPE_TWITTER);
            }
        } else {
            throw new NotSupportedException('This platform is not supported');
        }
    }

    private function checkClients($socialClient)
    {
        if (in_array($socialClient, array_keys(Yii::$app->authClientCollection->clients))) {
            return Yii::$app->authClientCollection->clients[$socialClient];
        }
        return false;
    }

    //todo checken if dit goed gaat en wel nete code is
    public function __destruct()
    {
        if (is_object($this->client->accessToken)) {
            if (!$this->client->accessToken->isValid) {
                return new UnauthorizedHttpException('accessToken is not valid');
            }
            $this->tokenModel->token = $this->client->accessToken->token;
            $this->tokenModel->token_secret = $this->client->accessToken->tokenSecret;
            if (!$this->tokenModel->save()) {
                throw new UnauthorizedHttpException('can\'t save token in database');
            }
        }
    }

    public function getUserAttributes()
    {
        return $this->client->getUserAttributes();
    }

    public function api($link, $params = [], $method = self::OAUTH_METHOD_POST)
    {
        return $this->client->api($link, $method, $params);
    }

    public function isValid()
    {
        if (!empty(($isValid = $this->client->accessToken))) {
            return $isValid->isValid;
        }
        return false;
    }

    public function getAuthUrl($clientName)
    {
        return Url::toRoute(['/site/auth', 'authclient' => $clientName]);
    }
}