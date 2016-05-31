<?php
namespace frontend\components\web;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * Class Controller
 * @package frontend\components\web
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
						'roles' => ['?'],
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
