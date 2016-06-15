<?php
/**
 * Created by PhpStorm.
 * User: reinier
 * Date: 06-06-16
 * Time: 12:45
 */
use yii\helpers\Html;
?>
<?= yii\authclient\widgets\AuthChoice::widget([
    'baseAuthUrl' => ['site/auth'],
    'popupMode' => false,
]) ?>