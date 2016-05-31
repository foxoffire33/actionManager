<?php

use backend\modules\user\Module;
use common\components\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\Role */
/* @var $users backend\modules\user\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Module::t('role', 'Role'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-view">

	<div class="content">

		<p>
			<?= Html::a(Yii::t('common', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
			<?php if ($model->name != 'admin'): ?>
				<?= Html::a(Yii::t('common', 'Delete'), ['delete', 'id' => $model->id], [
					'class' => 'btn btn-danger',
					'data'  => [
						'confirm' => Yii::t('common', 'Are you sure you want to delete this item?'),
						'method'  => 'post',
					],
				]) ?>
			<?php endif; ?>
		</p>

		<?= DetailView::widget([
			'model'      => $model,
			'attributes' => [
				'name',
				'description',
				'created_at:datetime',
				'updated_at:datetime',
			],
		]) ?>

		<!--		<h2>--><? //= Module::t('user', 'Users'); ?><!--</h2>-->
		<!--		--><? //= GridView::widget([
		//			'dataProvider' => new \yii\data\ArrayDataProvider(['allModels' => $roles]),
		//			'columns'      => [
		//				'name',
		//				'description',
		//				'createdAt:datetime',
		//				'updatedAt:datetime'
		//			],
		//		]); ?>

	</div>
</div>
