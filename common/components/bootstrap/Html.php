<?php

namespace common\components\bootstrap;

use yii\validators\StringValidator;

/**
 * Class Html
 * @package common\components\bootstrap
 */
class Html extends \yii\bootstrap\Html
{
	/**
	 * @param \yii\base\Model $model
	 * @param string $attribute
	 * @param array $options
	 * @return string
	 */
	public static function activeTextInput($model, $attribute, $options = [])
	{
		// Check for required
		if (isset($options['placeholder'])) {
			if ($model->isAttributeRequired($attribute)) {
				$options['placeholder'] .= '*';
			}
		}

		self::normalizeMaxLength($model, $attribute, $options);
		return static::activeInput('text', $model, $attribute, $options);
	}

	/**
	 * If `maxlength` option is set true and the model attribute is validated by a string validator,
	 * the `maxlength` option will take the value of [[\yii\validators\StringValidator::max]].
	 * @param Model $model the model object
	 * @param string $attribute the attribute name or expression.
	 * @param array $options the tag options in terms of name-value pairs.
	 */
	private static function normalizeMaxLength($model, $attribute, &$options)
	{
		if (isset($options['maxlength']) && $options['maxlength'] === true) {
			unset($options['maxlength']);
			$attrName = static::getAttributeName($attribute);
			foreach ($model->getActiveValidators($attrName) as $validator) {
				if ($validator instanceof StringValidator && $validator->max !== null) {
					$options['maxlength'] = $validator->max;
					break;
				}
			}
		}
	}
}


