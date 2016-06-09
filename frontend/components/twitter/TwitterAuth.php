<?php

/**
 * Created by PhpStorm.
 * User: reinier
 * Date: 09-06-16
 * Time: 13:42
 */
namespace frontend\components\twitter;

use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterAuth
{

    private $customer_key = 'E6QFE8kcJmbPaGdFAl1jEhk4Z';
    private $customer_secret = 'mXPHgFVOM7dGBXDgxFHdJdI8TiLJeCcnc1G8E9J52CMHqaeBSh';
    private $_client;

    public function __construct()
    {
        $this->_client = new TwitterOAuth($this->customer_key, $this->customer_secret);
    }

    public function getLoginUrl()
    {
        $request_token = $this->_client->oauth('oauth/request_token', ['oauth_callback' => 'http://' . $_SERVER['HTTP_HOST'] . '/site/twitter']);
        $_SESSION['oauth_token'] = $request_token['oauth_token'];
        $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
        return $this->_client->url('oauth/authorize', ['oauth_token' => $request_token['oauth_token']]);
    }

    public function checkToken($access_token, $access_token_secret)
    {
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token, $access_token_secret);
        //  $content = $connection->get("account/verify_credentials");
    }

    public function post($text)
    {
        //   var_dump($this->_client->post('statuses/update', ['status' => $text]));exit;
        //$this->_client->post('statuses/update', ['status' => $text]);
    }

}