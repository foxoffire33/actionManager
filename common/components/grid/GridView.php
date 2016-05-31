<?php
namespace common\components\grid;

/**
 * Class GridView
 * @package common\components\grid
 */
class GridView extends \yii\grid\GridView
{
	/** @var array */
	public $filterOptions = ['class' => 'filters form-control'];
	/** @var array */
	public $footerRowOptions = ['style' => 'font-weight:bold;'];

}