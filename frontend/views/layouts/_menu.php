<?php

/* @var $this \yii\web\View */

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

?>

<?php
NavBar::begin([
    'brandLabel' => 'yii2-enhanced',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);

$menuItems = [['label' => Yii::t('menu', 'Home'), 'url' => ['/site/index']]];
if (!Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => Yii::t('menu', 'Action'), 'url' => ['/action/index']];
    $menuItems[] = ['label' => Yii::t('menu', 'Logout'), 'url' => ['/user/logout']];
} else {
    $menuItems[] = ['label' => Yii::t('menu', 'Register'), 'url' => ['/user/registration']];
    $menuItems[] = ['label' => Yii::t('menu', 'Login'), 'url' => ['/user/login']];
}

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
]);
NavBar::end();
?>