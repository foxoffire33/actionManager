<?php

use frontend\components\web\ImageHelper;
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
    <h4><?= $model->intro ?></h4>

    <p>
        <?= Html::a(Yii::t('common', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('common', 'View'), ['action/landing-page', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('common', 'Delete'), ['delete', 'id' => $model->id], [
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
            'created_at:datetime',
            'updated_at:datetime',
            'created_by' => [
                'attribute' => 'created_by',
                'value' => $model->createdBy->email
            ],
            'updated_by' => [
                'attribute' => 'updated_by',
                'value' => $model->updatedBy->email
            ],
        ],
    ]) ?>

    <div class="row">
        <div class="col-sm-12">
            <h3>Action</h3>
            <?= Html::img(ImageHelper::convertToBase64($model->image), ['alt' => 'image', 'class' => 'img-responsive img-rounded']); ?>
            <p><?= nl2br($model->description); ?></p>
        </div>
        <div class="col-sm-4">
            <h3>Facebook</h3>
            <?= Html::img(ImageHelper::convertToBase64($model->image_facebook), ['alt' => 'facebook image', 'class' => 'img-responsive img-rounded']); ?>
            <p><?= nl2br($model->description_facebook); ?></p>
        </div>
        <div class="col-sm-4">
            <h3>Twitter</h3>
            <?= Html::img(ImageHelper::convertToBase64($model->image_twitter), ['alt' => 'twitter image', 'class' => 'img-responsive img-rounded']); ?>
            <p><?= nl2br($model->description_twitter); ?></p>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped">
            <?php //var_dump($model->reactions[17]->actionFieldsValue);exit; ?>
            <?php if (!empty($model->actionFields)): ?>
                <thead>
                <tr>
                    <?php foreach ($model->actionFields as $actionField): ?>
                        <th><?= $actionField->label ?></th>
                    <?php endforeach; ?>
                <tr>
                </thead>
            <?php endif; ?>
            <tbody>
            <?php if (!empty($model->reactions)): ?>
                <?php foreach ($model->reactions as $reaction): ?>
                    <tr>
                        <?php if (!empty($reaction->actionFieldsValue)): ?>
                            <?php foreach ($reaction->actionFieldsValue as $actionFieldValue): ?>
                                <td><?= $actionFieldValue->value ?></td>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
        </ul>

    </div>
