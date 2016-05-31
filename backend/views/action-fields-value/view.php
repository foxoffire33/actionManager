<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ActionFieldsValue */

$this->title = $model->reaction_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('actionFieldsValue', 'Action Fields Values'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="action-fields-value-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('actionFieldsValue', 'Update'), ['update', 'id' => $model->reaction_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('actionFieldsValue', 'Delete'), ['delete', 'id' => $model->reaction_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('actionFieldsValue', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'reaction_id',
            'action_field_id',
            'value:ntext',
            'ip',
            'created_at',
            'updated_at',
            'deleted_at',
        ],
    ]) ?>

</div>
