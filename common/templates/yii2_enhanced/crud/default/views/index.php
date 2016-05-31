<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

echo "<?php\n";
?>

use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use <?= $generator->indexWidgetType === 'grid' ? "common\\components\\grid\\GridView" : "yii\\widgets\\ListView" ?>;

/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('<?= lcfirst(Inflector::camel2id(StringHelper::basename($generator->modelClass))) ?>', '<?= Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-index">

	<h1><?= "<?= " ?>Html::encode($this->title) ?></h1>

	<div class="content">

<?php if(!empty($generator->searchModelClass)): ?>
	<?= "<?php " . ($generator->indexWidgetType === 'grid' ? "// " : "") ?>echo $this->render('_search', ['model' => $searchModel]); ?>
<?php endif; ?>

	<p>
		<?= "<?= " ?>Html::a(Yii::t('common', 'Create {modelClass}', ['modelClass' => Yii::t('<?= lcfirst(Inflector::camel2id(StringHelper::basename($generator->modelClass))) ?>', '<?= Inflector::camel2words(StringHelper::basename($generator->modelClass)) ?>')]), ['create'], ['class' => 'btn btn-success']) ?>
	</p>

<?php if ($generator->indexWidgetType === 'grid'): ?>
	<?= "<?= " ?>GridView::widget([
		'dataProvider' => $dataProvider,
		<?= !empty($generator->searchModelClass) ? "'filterModel' => \$searchModel,\n\t\t'columns' => [\n" : "'columns' => [\n"; ?>
<?php
$count = 0;
if (($tableSchema = $generator->getTableSchema()) === false) {
	foreach ($generator->getColumnNames() as $name) {
		if (++$count < 6) {
			echo "\t\t\t'" . $name . "',\n";
		} else {
			echo "\t\t\t// '" . $name . "',\n";
		}
	}
} else {
	foreach ($tableSchema->columns as $column) {
		$format = $generator->generateColumnFormat($column);

		if(in_array($column->name, ['created_at', 'updated_at']))
		{
			$format = 'datetime';
		}

		$line = $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";

		if($column->name == 'created_by')
		{
			if(++$count < 6)
			{
?>
			[
				'attribute' => 'created_by',
				'value' => 'created_by_name',
				'filter' => Html::activeDropDownList($searchModel, 'created_by', ArrayHelper::map(User::find()->asArray()->all(), 'id', 'username'), ['prompt' => Yii::t('common', 'Select')])
			],
<?php		}
			else
			{
?>
			// [
				// 'attribute' => 'created_by',
				// 'value' => 'created_by_name',
				// 'filter' => Html::activeDropDownList($searchModel, 'created_by', ArrayHelper::map(User::find()->asArray()->all(), 'id', 'username'), ['prompt' => Yii::t('common', 'Select')])
			// ],
<?php
			}
		}
		elseif($column->name == 'deleted_at')
		{

		}
		elseif($column->name == 'updated_by')
		{
			if(++$count < 1)
			{
?>
			[
				'attribute' => 'updated_by',
				'value' => 'updated_by_name',
				'filter' => Html::activeDropDownList($searchModel, 'updated_by', ArrayHelper::map(User::find()->asArray()->all(), 'id', 'username'), ['prompt' => Yii::t('common', 'Select')])
			],
<?php
			}
			else
			{
?>
			// [
				// 'attribute' => 'updated_by',
				// 'value' => 'updated_by_name',
				// 'filter' => Html::activeDropDownList($searchModel, 'updated_by', ArrayHelper::map(User::find()->asArray()->all(), 'id', 'username'), ['prompt' => Yii::t('common', 'Select')])
			// ],
<?php
			}
		}
		else
		{
			if (++$count < 6) {
				echo "\t\t\t'" . $line;
			} else {
				echo "\t\t\t// '" . $line;
			}
		}
	}
}
?>

			['class' => '\common\components\grid\ActionColumn'],
		],
	]); ?>
<?php else: ?>
	<?= "<?= " ?>ListView::widget([
		'dataProvider' => $dataProvider,
		'itemOptions' => ['class' => 'item'],
		'itemView' => function ($model, $key, $index, $widget) {
			return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
		},
	]) ?>
<?php endif; ?>

</div>
</div>
