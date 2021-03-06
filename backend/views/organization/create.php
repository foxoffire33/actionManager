<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Organization */

$this->title = Yii::t('organization', 'Create Organization');
$this->params['breadcrumbs'][] = ['label' => Yii::t('organization', 'Organizations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organization-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
