<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\modules\user\models\forms\PasswordResetRequestForm */

$this->title = \backend\modules\user\Module::t('reset', 'Request password reset');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-request-password-reset content">

	<br/>

	<p><?= \backend\modules\user\Module::t('reset', 'Please fill out your email. A link to reset password will be sent there.') ?></p>

	<div class="row">
		<div class="col-lg-5">
			<?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
			<?= $form->field($model, 'email') ?>
			<div class="form-group">
				<?= Html::submitButton(Yii::t('common', 'Send'), ['class' => 'btn btn-primary']) ?>
			</div>
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
