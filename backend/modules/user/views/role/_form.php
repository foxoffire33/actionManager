<?php

use common\components\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\Role */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rile-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'name' => 'role-button']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
