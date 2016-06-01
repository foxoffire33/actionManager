<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\organizationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('organization', 'Organizations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organization-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('organization', 'Create Organization'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'logo',
                'filter' => false,
                'format' => 'raw',
                'value' => function($data){
                    return Html::img($data->logoBase64,['width' => 40]);
                },
            ],
            'name',
            'address',
            'postal',
            'city',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
