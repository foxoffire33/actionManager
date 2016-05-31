<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\templates\yii2_enhanced\model;

use Yii;
use yii\gii\CodeFile;

/**
 * This generator will generate one or multiple ActiveRecord classes for the specified database table.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Generator extends \yii\gii\generators\model\Generator
{
	public $baseClass = 'common\components\db\ActiveRecord';

	/**
	 * @inheritdoc
	 */
	public function getName()
	{
		return 'yii2-enhanced Model';
	}

	/**
	 * @inheritdoc
	 */
	public function getDescription()
	{
		return 'yii2-enhanced model generator, creates our own templates based on the Yii::t standards etc';
	}

	/**
	 * Returns an array of attributes that are inherited from the base class
	 */
	public function inheritedAttributes()
	{
		return ['created_at', 'updated_at', 'created_by', 'updated_by', 'deleted_at'];
	}

	/**
	 * Returns an array of attributes for which the translation message should be in the 'common' file
	 */
	public function commonAttributes()
	{
		return ['id', 'name', 'created_at', 'updated_at', 'created_by', 'updated_by', 'deleted_at'];
	}

	/**
	 * @inheritdoc
	 */
	public function generate()
	{
		$files = [];
		$relations = $this->generateRelations();
		$db = $this->getDbConnection();
		foreach ($this->getTableNames() as $tableName) {
			// model :
			$modelClassName = $this->generateClassName($tableName);
			$queryClassName = ($this->generateQuery) ? $this->generateQueryClassName($modelClassName) : false;
			$tableSchema = $db->getTableSchema($tableName);
			$params = [
				'tableName'      => $tableName,
				'className'      => $modelClassName,
				'queryClassName' => $queryClassName,
				'tableSchema'    => $tableSchema,
				// $tableSchema acts as a reference, such that passing it directly to functions
				// would cause any possible column filtering they do to cascade
				'labels'         => $this->generateLabels(clone $tableSchema),
				'rules'          => $this->generateRules(clone $tableSchema),
				'relations'      => isset($relations[$tableName]) ? $relations[$tableName] : [],
			];
			$files[] = new CodeFile(
				Yii::getAlias('@' . str_replace('\\', '/', $this->ns)) . '/' . $modelClassName . '.php',
				$this->render('model.php', $params)
			);

			// query :
			if ($queryClassName) {
				$params = [
					'className'      => $queryClassName,
					'modelClassName' => $modelClassName,
				];
				$files[] = new CodeFile(
					Yii::getAlias('@' . str_replace('\\', '/', $this->queryNs)) . '/' . $queryClassName . '.php',
					$this->render('query.php', $params)
				);
			}

			// message :
			$files[] = new CodeFile(
				Yii::getAlias('@' . str_replace('\\', '/', 'common/messages/nl-NL')) . '/' . $this->messageCategory . '.php',
				$this->render('message.php', $params)
			);
		}

		return $files;
	}

	/**
	 * @inheritdoc
	 */
	public function generateRules($table)
	{
		// Don't generate rules for inherited attributes
		$table->columns = array_filter($table->columns, function ($column) {
			return !in_array($column->name, $this->inheritedAttributes());
		});

		return parent::generateRules($table);
	}

	/**
	 * @inheritdoc
	 */
	public function generateLabels($table)
	{
		// Don't generate labels for inherited attributes
		$table->columns = array_filter($table->columns, function ($column) {
			return !in_array($column->name, $this->inheritedAttributes());
		});

		return parent::generateLabels($table);
	}

	/**
	 * @inheritdoc
	 */
	public function generateRelations()
	{
		$relations = parent::generateRelations();

		// Tag relations belonging to inherited attributes as such
		foreach ($this->inheritedAttributes() as $inheritedAttribute) {
			foreach ($relations as $table => $tableRelations) {
				$rawNameOne = $this->generateRelationName([], $this->getDbConnection()->getTableSchema($table), $inheritedAttribute, false);
				$rawNameMany = $this->generateRelationName([], $this->getDbConnection()->getTableSchema($table), $inheritedAttribute, true);

				foreach ($tableRelations as $name => $tableRelation) {
					if (preg_match("/^($rawNameOne|$rawNameMany)\d*$/", $name)) {
						$relations[$table][$name]['inherited'] = true;
					}
				}
			}
		}

		return $relations;
	}
}
