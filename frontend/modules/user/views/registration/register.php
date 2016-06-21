<?php
use yii\widgets\ActiveForm;
use common\components\bootstrap\Html;
use frontend\modules\user\Module;
?>
<div class="col-sm-12">
    <h1><?= Module::t('signupForm', 'Register on Action manager'); ?></h1>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <?= $form->field($model,'email')->textInput(); ?>
        <?= $form->field($model, 'name')->textInput(); ?>
        <div class="form-group">
        <?= $form->field($model, 'address')->textInput(); ?>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <?= $form->field($model, 'postal')->textInput(); ?>
            </div>
            <div class="col-sm-8">
                <?= $form->field($model, 'city')->textInput(); ?>
            </div>
        </div>
        <?= $form->field($model, 'logo')->fileInput(); ?>
        <?= $form->field($model, 'description')->textarea(); ?>
    </div>
    <div class="row">
        <?= Html::submitButton(Module::t('signupForm', 'Register'), ['class' => 'btn btn-success']); ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>