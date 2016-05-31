<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = Yii::t('common', 'Create {modelClass}', ['modelClass' => Yii::t('<?= lcfirst(Inflector::camel2id(StringHelper::basename($generator->modelClass))) ?>', '<?= Inflector::camel2words(StringHelper::basename($generator->modelClass)) ?>')]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('<?= lcfirst(Inflector::camel2id(StringHelper::basename($generator->modelClass))) ?>', '<?= Inflector::camel2words(StringHelper::basename($generator->modelClass)) ?>'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-create">

	<h1><?= "<?= " ?>Html::encode($this->title) ?></h1>

	<div class="content">

	<?= "<?= " ?>$this->render('_form', [
		'model' => $model,
	]) ?>

	</div>

</div>
