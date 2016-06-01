<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Organization */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organization-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="form-group">
        <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="form-group">
        <div class="col-sm-4">
              <?= $form->field($model, 'postal')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-8">
           <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?= $form->field($model, 'logo')->fileInput() ?>

    <?= $form->field($model, 'description')->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('organization', 'Create') : Yii::t('organization', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
