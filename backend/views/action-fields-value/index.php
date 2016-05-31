<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ActionFieldsValue */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('actionFieldsValue', 'Action Fields Values');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="action-fields-value-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('actionFieldsValue', 'Create Action Fields Value'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'reaction_id',
            'action_field_id',
            'value:ntext',
            'ip',
            'created_at',
            // 'updated_at',
            // 'deleted_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
