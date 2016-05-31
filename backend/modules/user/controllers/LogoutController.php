<?php

namespace backend\modules\user\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use backend\components\web\Controller;

class LogoutController extends Controller
{
	/** @var string  */
	public $defaultAction = 'logout';

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return array_merge(parent::behaviors(), [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'actions' => ['logout'],
						'allow'   => true,
						'roles'   => ['@'],
					],
				],
			],
			'verbs'  => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'logout' => ['post'],
				],
			],
		]);
	}

	/**
	 * @return \yii\web\Response
	 */
	public function actionLogout()
	{
		Yii::$app->user->logout();

		return $this->goHome();
	}
}