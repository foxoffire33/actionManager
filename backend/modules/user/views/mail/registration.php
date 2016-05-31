<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$activateLink = Yii::$app->urlManager->createAbsoluteUrl(['/user/registration/activate', 'auth_key' => $user->auth_key]);
?>
<div class="password-reset">
	<p><?= \backend\modules\user\Module::t('registration', 'Hello colleague,') ?></p>

	<p><?= \backend\modules\user\Module::t('registration', 'Follow the link below to activate your account:'); ?></p>

	<p><?= Html::a(Html::encode($activateLink), $activateLink) ?></p>
</div>
