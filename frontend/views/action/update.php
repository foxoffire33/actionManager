<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Action */

$this->title = Yii::t('common', 'Update', [
    'modelClass' => 'Action',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('action', 'Actions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="action-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'actionFields' => $actionFields]) ?>

</div>
