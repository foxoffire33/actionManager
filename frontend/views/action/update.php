<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Action */

$this->title = Yii::t('action', 'Update {modelClass}: ', [
    'modelClass' => 'Action',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('action', 'Actions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('action', 'Update');
?>
<div class="action-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'actionFields' => $actionFields,
        'facebookLoginUrl' => $facebookLoginUrl
    ]) ?>

</div>
