<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ActionFieldsValue */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="action-fields-value-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reaction_id')->textInput() ?>

    <?= $form->field($model, 'action_field_id')->textInput() ?>

    <?= $form->field($model, 'value')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'deleted_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('actionFieldsValue', 'Create') : Yii::t('actionFieldsValue', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
