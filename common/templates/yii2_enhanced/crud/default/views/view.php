<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = $model-><?= $generator->getNameAttribute() ?>;
$this->params['breadcrumbs'][] = ['label' => Yii::t('<?= lcfirst(Inflector::camel2id(StringHelper::basename($generator->modelClass))) ?>', '<?= Inflector::camel2words(StringHelper::basename($generator->modelClass)) ?>'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-view">

	<h1><?= "<?= " ?>Html::encode($this->title) ?></h1>

	<div class="content">

	<p>
		<?= "<?= " ?>Html::a(Yii::t('common', 'Update'), ['update', <?= $urlParams ?>], ['class' => 'btn btn-primary']) ?>
		<?= "<?= " ?>Html::a(Yii::t('common', 'Delete'), ['delete', <?= $urlParams ?>], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => Yii::t('common', 'Are you sure you want to delete this item?'),
				'method'  => 'post',
			],
		]) ?>
	</p>

	<?= "<?= " ?>DetailView::widget([
		'model' => $model,
		'attributes' => [
<?php

if (($tableSchema = $generator->getTableSchema()) === false) {
	foreach ($generator->getColumnNames() as $name) {
		echo "\t\t\t'" . $name . "',\n";
	}
} else {
	foreach ($generator->getTableSchema()->columns as $column) {
		$format = $generator->generateColumnFormat($column);

		if($column->name == 'created_at' || $column->name == 'updated_at')
		{
			$format = 'datetime';
		}

		if($column->name == 'created_by')
		{
?>
			[
				'attribute' => 'created_by',
				'value'     => $model->created_by_name
			],
<?php
		}
		elseif($column->name == 'updated_by')
		{
?>
			[
				'attribute' => 'updated_by',
				'value'     => $model->updated_by_name
			],
<?php
		}
		elseif($column->name == 'deleted_at')
		{
?>
<?php
		}
		else{
			echo "\t\t\t'" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
		}
	}
}
?>
		],
	]) ?>
	</div>
</div>
