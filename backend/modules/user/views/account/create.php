<?php

use backend\modules\user\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\user\models\User */

$this->title = Yii::t('common', 'Create {modelClass}', ['modelClass' => Module::t('user', 'User')]);
$this->params['breadcrumbs'][] = ['label' => Module::t('user', 'User'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">
	<div class="content">

		<?= $this->render('_form', [
			'model' => $model,
		]) ?>

	</div>

</div>
