<?php
namespace backend\components\web;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * Class Controller
 * @package backend\components\web
 */
class Controller extends \yii\web\Controller
{
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'allow' => true,
						'roles' => ['admin'],
					],
				],
			],
			'verbs'  => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
		];
	}

}
