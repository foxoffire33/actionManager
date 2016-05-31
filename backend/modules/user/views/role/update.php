<?php

use backend\modules\user\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\Role */

$this->title = Yii::t('common', 'Update {modelClass}', ['modelClass' => Module::t('role', 'Role')]) . ' ' . $model->name;

$this->params['breadcrumbs'][] = ['label' => Module::t('role', 'Role'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>
<div class="role-update">

	<div class="content">

		<?= $this->render('_form', [
			'model' => $model,
		]) ?>

	</div>
</div>
