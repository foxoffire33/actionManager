<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\modules\user\models\forms\ResetPasswordForm */

$this->title = \backend\modules\user\Module::t('reset', 'Reset password');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password content">
	<h1><?= Html::encode($this->title) ?></h1>

	<p><?= \backend\modules\user\Module::t('reset', 'Please choose your new password:'); ?></p>

	<div class="row">
		<div class="col-lg-5">
			<?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
			<?= $form->field($model, 'password')->passwordInput() ?>
			<div class="form-group">
				<?= Html::submitButton(Yii::t('common', 'Save'), ['class' => 'btn btn-primary']) ?>
			</div>
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
