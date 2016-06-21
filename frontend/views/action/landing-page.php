<?php
use common\models\ActionFields;
use frontend\components\web\ImageHelper;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<div class="col-xs-12">
    <div class="row">
        <h1>            
            <?= $model->name ?>
        </h1>
        <?php if (!empty($model->image)): ?>
                <?= Html::img(ImageHelper::convertToBase64($model->image), ['height' => 400, 'align' => 'center']) ?>
            <?php endif; ?>
    </div>
    <div>
        <div class="form-group">
            <strong><?= $model->intro ?></strong>
        </div>
        <div class="form-group">
        <?= nl2br($model->description); ?>
    </div>
        <?php if (!is_null($landingPageModel)): ?>
            <div class="form-group">
                <?php if (!empty($landingPageModel)): ?>
                    <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']]); ?>
                    <?php $index = 0; ?>
                    <?php foreach ($landingPageModel->attributes() as $attribute): ?>
                        <?php $field = $form->field($landingPageModel, $attribute); ?>
                        <?php if (ActionFields::findOne(['action_id' => $model->id, 'label' => $attribute])->type == ActionFields::TYPE_TEXT): ?>
                            <?= $field->textInput(); ?>
                        <?php else: ?>
                            <?= $field->checkBox(); ?>
                        <?php endif; ?>

                        <?php $index++; ?>
                    <?php endforeach; ?>
                    <div class="form-group">
            <?= Html::submitButton(Yii::t('common','Send'),['class' => 'btn btn-success col-sm-12']); ?>
            </div>
                    <?php ActiveForm::end(); ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>