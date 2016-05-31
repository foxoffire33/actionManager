<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ActionFieldsValue */

$this->title = Yii::t('actionFieldsValue', 'Update {modelClass}: ', [
    'modelClass' => 'Action Fields Value',
]) . $model->reaction_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('actionFieldsValue', 'Action Fields Values'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->reaction_id, 'url' => ['view', 'id' => $model->reaction_id]];
$this->params['breadcrumbs'][] = Yii::t('actionFieldsValue', 'Update');
?>
<div class="action-fields-value-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
