<?php

use backend\modules\user\Module;
use common\components\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\User */
/* @var $roles_data_provider yii\data\ActiveDataProvider */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Module::t('user', 'User'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

	<div class="content">

		<p>
			<?= Html::a(Yii::t('common', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
			<?php if ($model->id > 1): ?>
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
				'username',
				'email',
				'created_at:datetime',
				'updated_at:datetime',
			],
		]) ?>

		<h2><?= Module::t('role', 'Roles'); ?></h2>
		<?= GridView::widget([
			'dataProvider' => $roles_data_provider,
			'columns'      => [
				'name',
				'description',
				'created_at:datetime',
				'updated_at:datetime'
			],
		]); ?>


	</div>
</div>
