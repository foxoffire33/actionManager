<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['/user/reset/change', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
	<p><?= \backend\modules\user\Module::t('reset', 'Hello colleague,') ?></p>

	<p><?= \backend\modules\user\Module::t('reset', 'Follow the link below to reset your password:'); ?></p>

	<p><?= Html::a(\backend\modules\user\Module::t('reset', 'Reset password.'), $resetLink, [
			'class' => 'btn btn-primary'
		]) ?></p>
</div>
