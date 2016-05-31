<?php

/* @var $this \yii\web\View */

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

?>

<?php
NavBar::begin([
	'brandLabel' => 'yii2-enhanced',
	'brandUrl'   => Yii::$app->homeUrl,
	'options'    => [
		'class' => 'navbar-inverse navbar-fixed-top',
	],
]);
echo Nav::widget([
	'options' => ['class' => 'navbar-nav navbar-right'],
	'items'   => [
		['label' => Yii::t('menu', 'Home'), 'url' => ['/site/index']],
		['label' => Yii::t('menu', 'About'), 'url' => ['/site/about']],
		['label' => Yii::t('menu', 'Contact'), 'url' => ['/site/contact']],
	],
]);
NavBar::end();
?>