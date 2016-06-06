<?php
/**
 * Created by PhpStorm.
 * User: reinier
 * Date: 06-06-16
 * Time: 13:50
 */
namespace frontend\components\authClient;

use app\models\Token;
use Yii;

class FacebookHelper
{

    private $_client;
    private $_tokenModel;

    public function __construct($client)
    {
        $this->_client = $client;
        if (!empty(($model = Token::findOne(['user_id' => Yii::$app->user->id])))) {
            $this->_tokenModel = $model;
        }
    }

    public function post($text)
    {
        return $this->_client->api('/me/feed', 'post', ['message' => $text]);
    }

}