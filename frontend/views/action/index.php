<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\components\web\ImageHelper;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ActionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('action', 'Actions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="action-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('action', 'Create Action'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
  <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'image',
                'filter' => false,
                'format' => 'raw',
                'value' => function($data){
                    if (empty($data->image)) {
                        return Yii::t('action', 'No image found');
                    } else {
                        return Html::img(ImageHelper::convertToBase64($data->image), ['width' => 40]);
                    }
                },
            ],
            'name',
            'intro',
            'description:ntext',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
