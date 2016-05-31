<?php

use backend\modules\user\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\Role */

$this->title = Yii::t('common', 'Create {modelClass}', ['modelClass' => Module::t('role', 'Role')]);
$this->params['breadcrumbs'][] = ['label' => Module::t('role', 'Role'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-create">

	<div class="content">

		<?= $this->render('_form', [
			'model' => $model,
		]) ?>

	</div>

</div>
