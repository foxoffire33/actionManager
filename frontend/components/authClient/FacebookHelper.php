<?php
/**
 * Created by PhpStorm.
 * User: reinier
 * Date: 06-06-16
 * Time: 13:50
 */
namespace frontend\components\authClient;

use common\models\Token;
use Facebook\Authentication\AccessToken;
use Yii;
use yii\authclient\OAuthToken;
use yii\base\Exception;

class FacebookHelper
{

    private $_client;
    private $_tokenModel;

    public function __construct($client)
    {
        $this->_client = $client;
        //check of er een model is
        if (!empty(($model = Token::findOne(['user_id' => Yii::$app->user->id])))) {
            $this->_tokenModel = $model;
            $this->_client->setAccessToken(new BaseOAuth(['token' => $model->token]));
        } else {
            $this->_tokenModel = new Token();
            $this->_tokenModel->user_id = Yii::$app->user->id;
        }

        ///check access token en update deze
        $accessToken = $this->_client->accessToken;
        if ($accessToken->isValid && $this->_client->accessToken->token != $accessToken->token) {
            $this->_tokenModel->rokwn = $accessToken->token;
            $this->_tokenModel->save(false);
        } elseif (!$this->_tokenModel->isNewRecord && $accessToken->isValid) {
            $this->_tokenModel->delete();
        }

    }

    public function post($text)
    {
        try {
            return $this->_client->api('/me/feed', 'post', ['message' => $text]);
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

}