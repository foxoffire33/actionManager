<?php
namespace frontend\components\authClient;

use common\models\Token;
use Yii;
use yii\authclient\ClientInterface;
use yii\authclient\clients\Facebook;
use yii\authclient\OAuthToken;
use yii\web\UnauthorizedHttpException;

/**
 * AuthHandler handles successful authentification via Yii auth component
 */
class AuthHandler
{
    /**
     * @var ClientInterface
     */
    private $client;
    private $tokenModel;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
        $this->tokenModel = Token::findOne(['user_id' => Yii::$app->user->id, 'type' => (is_a($this->client, Facebook::className()) ? Token::TYPE_FACEBOOK : Token::TYPE_TWITTER)]);
        if (!is_null(($this->tokenModel))) {
            $this->client->setAccessToken(new OAuthToken(['token' => $this->tokenModel->token,'tokenSecret' => $this->tokenModel->token_secret]));
        }else{
            $this->tokenModel = new Token();
            $this->tokenModel->user_id = \Yii::$app->user->id;
            $this->tokenModel->type = (is_a($this->client, Facebook::className()) ? Token::TYPE_FACEBOOK : Token::TYPE_TWITTER);
        }
    }

    //todo checken if dit goed gaat en wel nete code is
    public function __destruct()
    {
        if(!$this->client->accessToken->isValid){
            return new UnauthorizedHttpException('accessToken is not valid');
        }
        $this->tokenModel->token = $this->client->accessToken->token;
        $this->tokenModel->token_secret = $this->client->accessToken->tokenSecret;
        if(!$this->tokenModel->save()){
            throw new UnauthorizedHttpException('can\'t save token in database');
        }
    }

    public function getUserAttributes(){
        return $this->client->getUserAttributes();
    }
}