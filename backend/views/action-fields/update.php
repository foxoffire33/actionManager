<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ActionFields */

$this->title = Yii::t('actionFields', 'Update {modelClass}: ', [
    'modelClass' => 'Action Fields',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('actionFields', 'Action Fields'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('actionFields', 'Update');
?>
<div class="action-fields-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
