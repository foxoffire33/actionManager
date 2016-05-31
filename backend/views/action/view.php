<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Action */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('action', 'Actions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="action-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('action', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('action', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('action', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'organization_id',
            'name',
            'intro',
            'description:ntext',
            'image',
            'image_facebook',
            'description_facebook:ntext',
            'image_twitter',
            'description_twitter:ntext',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
            'deleted_at',
        ],
    ]) ?>

</div>
