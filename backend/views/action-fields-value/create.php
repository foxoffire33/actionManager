<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ActionFieldsValue */

$this->title = Yii::t('actionFieldsValue', 'Create Action Fields Value');
$this->params['breadcrumbs'][] = ['label' => Yii::t('actionFieldsValue', 'Action Fields Values'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="action-fields-value-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
