<?php
/**
 * Created by PhpStorm.
 * User: reinier
 * Date: 09-06-16
 * Time: 10:50
 */

namespace frontend\components\facebook;

use Facebook\Authentication\AccessToken;
use Facebook\Facebook;

class Auth
{
    private $_client;
    private $app_id = '1034207386656125';
    private $client_id = '23efaaf565279ea7a8c93c1f388590b1';
    private $scope = ['user_managed_groups', 'user_posts', 'publish_actions'];

    public function __construct()
    {
        $this->_client = new Facebook([
            'app_id' => $this->app_id,
            'app_secret' => $this->client_id,
            'default_graph_version' => 'v2.2',
        ]);

    }

    public function getLoginUrl()
    {
        return $this->_client->getRedirectLoginHelper()->getLoginUrl('http://' . $_SERVER['SERVER_NAME'] . '/site/facebook', $this->scope);
    }

    public function post($link, $mssage)
    {
        if (!empty(($accessToken = $this->getAccessToken()))) {
            return $this->_client->post('/me/feed', ['link' => $link, 'message' => $mssage], $accessToken);
        }
        return false;
    }

    //deze function handeld alle get acties af

    public function getAccessToken()
    {
        $token = \Yii::$app->user->identity->token;
        if (!empty(($token = \Yii::$app->user->identity->token))) {
            $this->_client->setDefaultAccessToken($token->token);
        }
        if (!empty(($access_token = $this->_client->getRedirectLoginHelper()->getAccessToken()))) {
            return $access_token;
        } elseif (!empty($token->token)) {
            $newToken = $this->getExtendedAccessToken($token->token);
            $token->token = $newToken;
            if ($token->save()) {
                $this->_client->setDefaultAccessToken(new AccessToken(['access_token' => $token->token]));
                return $newToken;
            }
        }
        return null;
    }

    public function getExtendedAccessToken($access_token)
    {

        $token_url = "https://graph.facebook.com/oauth/access_token";
        $params = ['client_id' => $this->app_id, 'client_secret' => $this->client_id, 'grant_type' => 'fb_exchange_token', 'fb_exchange_token' => $access_token];

        $curl = curl_init($token_url);
        curl_setopt($curl, CURLOPT_URL, $token_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);

        $respone = curl_exec($curl);
        curl_close($curl);
        if (!is_null($respone)) {
            $explode = explode('=', $respone);
            if (isset($explode[1])) {
                $explode = explode('&', $explode[1]);
                return $explode[0];
            }
        }
        return false;

    }

    public function setDefaultAccessToken($token)
    {
        return $this->_client->setDefaultAccessToken(new AccessToken(['access_token' => $token]));
    }


}