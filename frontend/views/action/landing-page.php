<?php
use frontend\components\web\ImageHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<div class="col-sm-12">
    <div class="row">
        <h1><?= Html::img(ImageHelper::convertToBase64($model->image), ['class' => 'img-rounded img-circle', 'height' => 120]) ?> <?= $model->name ?></h1>
    </div>
    <div>
        <div class="row">
            <strong><?= $model->intro ?></strong>
        </div>
        <div class="row">
        <?= nl2br($model->description); ?>
    </div>
        <div class="row">
            <?php if (!empty($landingPageModel)): ?>
                <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']]); ?>
                <?php $index = 0; ?>
                <?php foreach ($landingPageModel->attributes() as $attribute): ?>
                    <?= $form->field($landingPageModel, $attribute)->textInput(); ?>
                    <?php $index++; ?>
                <?php endforeach; ?>
                <div class="row">
            <?= Html::submitButton(Yii::t('common','Send'),['class' => 'btn btn-success col-sm-12']); ?>
            </div>
                <?php ActiveForm::end(); ?>
            <?php endif; ?>
        </div>
    </div>
</div>