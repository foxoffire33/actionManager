<?php

/**
 * Created by PhpStorm.
 * User: reinier
 * Date: 09-06-16
 * Time: 13:42
 */
namespace frontend\components\twitter;

use Abraham\TwitterOAuth\TwitterOAuth;
use common\models\Token;
use yii;

class TwitterAuth
{

    private $customer_key = 'E6QFE8kcJmbPaGdFAl1jEhk4Z';
    private $customer_secret = 'mXPHgFVOM7dGBXDgxFHdJdI8TiLJeCcnc1G8E9J52CMHqaeBSh';
    public $_client;

    public function __construct($accessToken = null, $accessTokenSecret = null)
    {
        if (!is_null($accessToken) && !is_null($accessTokenSecret)) {
            $this->_client = new TwitterOAuth($this->customer_key, $this->customer_secret, $accessToken, $accessTokenSecret);
        } elseif (!is_null(($model = Token::findOne(['user_id' => Yii::$app->user->id, 'type' => Token::TYPE_TWITTER])))) {
            $this->_client = new TwitterOAuth($this->customer_key, $this->customer_secret, $model->token, $model->token_secret);
        } else {
            $this->_client = new TwitterOAuth($this->customer_key, $this->customer_secret);
        }
    }

    public function getLoginUrl()
    {
        $request_token = $this->_client->oauth('oauth/request_token', ['oauth_callback' => 'http://' . $_SERVER['HTTP_HOST'] . '/site/twitter']);
        $_SESSION['oauth_token'] = $request_token['oauth_token'];
        $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
        return $this->_client->url('oauth/authorize', ['oauth_token' => $request_token['oauth_token']]);
    }


    public function post($text, $link)
    {
        return $this->_client->post("statuses/update", ["status" => substr($text, 0, (140 - strlen($link))) . $link]);
    }

}