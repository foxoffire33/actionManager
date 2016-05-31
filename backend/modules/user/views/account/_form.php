<?php

use common\components\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

	<fieldset>
		<legend><?= \backend\modules\user\Module::t('user', 'Password details'); ?></legend>
		<?= $form->field($model, 'enter_password')->passwordInput(); ?>
		<?= $form->field($model, 'repeat_password')->passwordInput(); ?>
	</fieldset>

	<fieldset>
		<legend><?= \backend\modules\user\Module::t('role', 'Role'); ?></legend>
		<?= $form->field($model, 'roles')->checkboxList(\yii\helpers\ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description')); ?>
	</fieldset>

	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'name' => 'account-button']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
