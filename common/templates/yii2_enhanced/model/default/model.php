<?php
/**
 * This is the template for generating the model class of a specified table.
 */

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\model\Generator */
/* @var $tableName string full table name */
/* @var $className string class name */
/* @var $tableSchema yii\db\TableSchema */
/* @var $labels string[] list of attribute labels (name => label) */
/* @var $rules string[] list of validation rules */
/* @var $relations array list of relations (name => relation declaration) */

// Find the longest attribute name
$maxAttributeLength = array_reduce(array_keys($labels), function ($carry, $item) {
	return max($carry, strlen($item));
}, 0);

echo "<?php\n";
?>

namespace <?= $generator->ns ?>;

use Yii;

/**
 * This is the model class for table "<?= $generator->generateTableName($tableName) ?>".
 *
<?php foreach ($tableSchema->columns as $column): ?>
 * @property <?= "{$column->phpType} \${$column->name}\n" ?>
<?php endforeach; ?>
<?php if (!empty($relations)): ?>
 *
<?php foreach ($relations as $name => $relation): ?>
 * @property <?= $relation[1] . ($relation[2] ? '[]' : '') . ' $' . lcfirst($name) . "\n" ?>
<?php endforeach; ?>
<?php endif; ?>
 */
class <?= $className ?> extends <?= '\\' . ltrim($generator->baseClass, '\\') . "\n" ?>
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '<?= $generator->generateTableName($tableName) ?>';
	}
<?php if ($generator->db !== 'db'): ?>

	/**
	 * @return \yii\db\Connection the database connection used by this AR class.
	 */
	public static function getDb()
	{
		return Yii::$app->get('<?= $generator->db ?>');
	}
<?php endif; ?>

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [<?= "\n\t\t\t" . implode(",\n\t\t\t", $rules) . "\n\t\t" ?>];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return array_merge(parent::attributeLabels(), [
<?php foreach ($labels as $name => $label): ?>
<?php if (in_array($name, $generator->commonAttributes())): ?>
			<?= "'$name' " . str_repeat(' ', $maxAttributeLength - strlen($name)) . "=> Yii::t('common', '" . $label . "'),\n" ?>
<?php else: ?>
			<?= "'$name' " . str_repeat(' ', $maxAttributeLength - strlen($name)) . "=> " . $generator->generateString($label) . ",\n" ?>
<?php endif; ?>
<?php endforeach; ?>
		]);
	}
<?php foreach ($relations as $name => $relation): ?>
<?php if (!isset($relation['inherited']) || !$relation['inherited']): ?>

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function get<?= $name ?>()
	{
		<?= $relation[0] . "\n" ?>
	}
<?php endif; ?>
<?php endforeach; ?>
}
