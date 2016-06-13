<?php
use yii\widgets\ActiveForm;
use common\components\bootstrap\Html;
use frontend\modules\user\Module;
?>
<div class="col-sm-12">
    <h1><?= Module::t('signupForm', 'Register on Action manager'); ?></h1>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <h2><?= Module::t('signupForm', 'Organization information') ?></h2>
        <?= $form->field($model, 'name')->textInput(); ?>
        <?= $form->field($model, 'address')->textInput(); ?>
        <?= $form->field($model, 'city')->textInput(); ?>
        <?= $form->field($model, 'logo')->fileInput(); ?>
        <?= $form->field($model, 'description')->textarea(); ?>
    </div>
    <div class="form-group">
        <h2><?= Module::t('signupForm', 'User account') ?></h2>
        <div class="col-sm-12">
            <?= $form->field($model, 'username'); ?>
                <?= $form->field($model,'email')->textInput(); ?>
        </div>
    </div>
    <div class="row">
        <?= Html::submitButton(Module::t('signupForm', 'Register'), ['class' => 'btn btn-success']); ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>