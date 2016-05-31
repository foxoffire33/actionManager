<?php
namespace common\components\validators;

use Yii;

/**
 * Class CompareValidator
 * @package common\components\validators
 */
class CompareValidator extends \yii\validators\CompareValidator
{
	/**
	 * @var string the type of the values being compared. The follow types are supported:
	 *
	 * - string: the values are being compared as strings. No conversion will be done before comparison.
	 * - number: the values are being compared as numbers. String values will be converted into numbers before comparison.
	 * - date: the values are being compared as date. String values will be converted with strtotime() before comparison.
	 */
	public $type = 'string';

	/**
	 * Compares two values with the specified operator.
	 * @param string $operator the comparison operator
	 * @param string $type the type of the values being compared
	 * @param mixed $value the value being compared
	 * @param mixed $compareValue another value being compared
	 * @return boolean whether the comparison using the specified operator is true.
	 */
	protected function compareValues($operator, $type, $value, $compareValue)
	{
		switch ($this->type) {
			case 'number':
				$value = (float)$value;
				$compareValue = (float)$compareValue;
				break;
			case 'date':
				$value = strtotime($value);
				$compareValue = strtotime($compareValue);
				break;
			default:
				$value = (string)$value;
				$compareValue = (string)$compareValue;
				break;
		}

		switch ($operator) {
			case '==':
				return $value == $compareValue;
			case '===':
				return $value === $compareValue;
			case '!=':
				return $value != $compareValue;
			case '!==':
				return $value !== $compareValue;
			case '>':
				return $value > $compareValue;
			case '>=':
				return $value >= $compareValue;
			case '<':
				return $value < $compareValue;
			case '<=':
				return $value <= $compareValue;
			default:
				return false;
		}
	}
}