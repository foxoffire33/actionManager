<?php
/**
 * This is the template for generating the messages file of the model
 */

use yii\helpers\Inflector;

/* @var $labels string[] list of attribute labels (name => label) */

// Ignore labels which belong in 'common'
// Find the length of the longest remaining label
$maxLabelLength = 0;
foreach ($labels as $name => $label) {
	if (in_array($name, $generator->commonAttributes())) {
		unset($labels[$name]);
	} else {
		$maxLabelLength = max($maxLabelLength, strlen($label));
	}
}

// Determine the difference between the singular and plural $className
$pluralDiff = strlen(Inflector::pluralize($className)) - strlen($className);

echo "<?php\n";
?>
/**
 * nl-NL
 * <?= lcfirst($className) ?> message file
 */

return [
	/** Class name */
	<?= "'$className' " . str_repeat(' ', $pluralDiff > 0 ? $pluralDiff : 0) . "=> '',\n" ?>
	<?= "'" . Inflector::pluralize($className) . "' " . str_repeat(' ', $pluralDiff < 0 ? -$pluralDiff : 0) . "=> '',\n" ?>

	/** Attributes */
<?php foreach ($labels as $name => $label): ?>
	<?= "'$label' " . str_repeat(' ', $maxLabelLength - strlen($label)) . "=> '',\n" ?>
<?php endforeach; ?>

	/** Miscellaneous */
];
