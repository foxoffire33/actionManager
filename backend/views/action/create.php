<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Action */

$this->title = Yii::t('action', 'Create Action');
$this->params['breadcrumbs'][] = ['label' => Yii::t('action', 'Actions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="action-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
