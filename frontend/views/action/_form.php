<?php

use common\models\ActionFields;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Action */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="action-form">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'post_on_facebook')->checkBox(['onclick' => 'window.open("' . $facebookLoginUrl . '");']) ?>
        <?= $form->field($model, 'post_on_twitter')->checkBox() ?>
        <div class="row">
            <div class="col-sm-12">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'intro')->textInput(['maxlength' => true]) ?>
        </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'image_virtual')->fileInput(['maxlength' => true]) ?>
        </div>
            <div class="col-sm-9">
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <?= $form->field($model, 'image_facebook_virtual')->fileInput() ?>
    </div>
            <div class="col-sm-9">
            <?= $form->field($model, 'description_facebook')->textarea(['rows' => 6]) ?>
        </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <?= $form->field($model, 'image_twitter_virtual')->fileInput() ?>
        </div>
            <div class="col-sm-9">
            <?= $form->field($model, 'description_twitter')->textarea(['rows' => 6]) ?>
        </div>
        </div>
        <div class="col-sm-12 row">
            <h2>Action fields</h2>
            <table class="table-striped col-sm-12" id="lines">
                <thead>
                <tr>
                    <td><?= yii::t('actionFields', 'Name'); ?></td>
                    <td><?= yii::t('actionFields', 'Label'); ?></td>
                    <td><?= yii::t('actionFields', 'type'); ?></td>
                    <td><?= yii::t('actionFields', 'Required'); ?></td>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($actionFields)): ?>
                    <?php $actionFields[] = new ActionFields() ?>
                <?php endif; ?>
                <?php $index = 0; ?>
                <?php foreach ($actionFields as $actionField): ?>
                    <tr>
                        <td><?= $form->field($actionField, 'name')->textInput(['name' => "ActionFields[$index][name]"])->label(false); ?></td>
                        <td><?= $form->field($actionField, 'label')->textInput(['name' => "ActionFields[$index][label]"])->label(false); ?></td>
                        <td><?= $form->field($actionField, 'type')->dropDownList([ActionFields::TYPE_TEXT => Yii::t('actionFields', 'Text'), ActionFields::TYPE_CHECKBOX => Yii::t('ActionFields', 'Checkbox')], ['name' => "ActionFields[$index][type]"])->label(false) ?></td>
                        <td><?= $form->field($actionField, 'required', ['template' => '{input}'])->checkBox(['name' => "ActionFields[$index][required]"], false); ?></td>
                        <td><?= $form->field($actionField, 'id')->hiddenInput(['name' => "ActionFields[$index][id]"])->label(false) ?>
                            <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', '#', ['class' => 'remove-invoice-line']) ?></td>
                    </tr>
                    <?php $index++ ?>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="form-group">
                <?= Html::a(Yii::t('invoice', 'Add invoice line'), null, ['class' => 'btn btn-success', 'id' => 'add-line']) ?>
            </div>
        </div>
        <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('action', 'Create') : Yii::t('action', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

        <?php ActiveForm::end(); ?>

    </div>
<?php
$nextIndex = count($actionFields);
$typeOptions = [ActionFields::TYPE_TEXT => Yii::t('actionFields', 'Text'), ActionFields::TYPE_CHECKBOX => Yii::t('actionFields', 'Checkbox')];
$this->registerJs('
    var nextIndex = ' . $nextIndex . ';
    $(\'#add-line\').click(addLine);
    var typeOptions =' . JSON::encode($typeOptions) . ';

    $(\'.remove-invoice-line\').click(removeLine);

    function addLine()
    {
        $newRow = $(\'<tr />\');
        $(\'<td />\').append(formGroup(\'name\', textInput(\'name\'))).appendTo($newRow);
        $(\'<td />\').append(formGroup(\'label\', textInput(\'label\'))).appendTo($newRow);
        $(\'<td />\').append(formGroup(\'type_id\', selectInput(\'type\',$(typeOptions)))).appendTo($newRow);
        $(\'<td />\').append(formGroup(\'required\',checkBox(\'required\'))).appendTo($newRow);
        $(\'<td />\').append(hiddenInput(\'id\')).append(deleteIcon()).appendTo($newRow);
        $(\'#lines tbody\').append($newRow);
        ++nextIndex;
    }
function removeLine()
{
$(this).closest(\'tr\').remove();
return false;
}
function textInput(attribute)
{
return $(\'<input/>\', {
id: \'ActionFields\' + nextIndex + \'-\' + attribute.toLowerCase(),
class: \'form-control\',
type: \'text\',
name: \'ActionFields[\' + nextIndex + \'][\' + attribute + \']\'
});
}
    function selectInput(attribute, options)
        {
        $select =  $(\'<select/>\', {
            id: \'ActionFields\' + nextIndex + \'-\' + attribute.toLowerCase(),
            class: \'form-control\',
            name: \'ActionFields[\' + nextIndex + \'][\' + attribute + \']\'
        });
        $(options).each(function(key,option) {
            $select.append($(\'<option />\', {
                text: option,
                value: key
            }));
        });
        return $select;
    }

    function checkBox(attribute){
        return $(\'<input />\').attr({
                id: \'ActionFields\' + nextIndex + \'-\' + attribute.toLowerCase(),
                type: \'checkbox\',
                name: \'ActionFields[\' + nextIndex + \'][\' + attribute + \']\'
            });
    }

    function formGroup(attribute, input)
    {
        return $(\'<div/>\', {
            class: \'form-group field-ActionFields\' + nextIndex + \'-\' + attribute.toLowerCase() + \' required\'
        }).append(input);
    }

    function hiddenInput(attribute)
        {
            return $(\'<input/>\', {
                id: \'ActionFields\' + nextIndex + \'-\' + attribute.toLowerCase(),
                type: \'hidden\',
                name: \'ActionFields[\' + nextIndex + \'][\' + attribute + \']\'
            });
    }
function deleteIcon()
{
return $(\'<a/>\', {
class: \'remove-invoice-line\',
href: \'#\'
}).append($(\'<span/>\', {
class: \'glyphicon glyphicon-trash\'
})).click(removeLine);
}');
?>