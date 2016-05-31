<?php

use backend\modules\user\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\User */

$this->title = Yii::t('common', 'Update {modelClass}', ['modelClass' => Module::t('user', 'User')]) . ' ' . $model->username;

$this->params['breadcrumbs'][] = ['label' => Module::t('user', 'User'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="user-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<div class="content">

		<?= $this->render('_form', [
			'model' => $model,
		]) ?>

	</div>
</div>
