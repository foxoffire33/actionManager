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
$menuItems = [];

if (Yii::$app->user->isGuest) {
	$menuItems[] = ['label' => Yii::t('menu', 'Registration'), 'url' => ['/user/registration']];
	$menuItems[] = ['label' => Yii::t('menu', 'Login'), 'url' => ['/user/login']];
} else {

	$menuItems[] = ['label' => Yii::t('menu', 'Home'), 'url' => ['/site/index']];

	if (Yii::$app->user->isAdmin()) {
		$menuItems[] = ['label' => Yii::t('menu', 'Account'), 'url' => ['/user/account']];
		$menuItems[] = ['label' => Yii::t('menu', 'Roles'), 'url' => ['/user/role']];
	}

	$menuItems[] = [
		'label'       => Yii::t('menu', 'Logout ({username})', ['username' => Yii::$app->user->identity->username]),
		'url'         => ['/user/logout'],
		'linkOptions' => ['data-method' => 'post']
	];
}
echo Nav::widget([
	'options' => ['class' => 'navbar-nav navbar-right'],
	'items'   => $menuItems,
]);
NavBar::end();
?>