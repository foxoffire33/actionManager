<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ActionFields */

$this->title = Yii::t('actionFields', 'Create Action Fields');
$this->params['breadcrumbs'][] = ['label' => Yii::t('actionFields', 'Action Fields'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="action-fields-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
