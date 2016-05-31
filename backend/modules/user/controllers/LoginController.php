<?php

namespace backend\modules\user\controllers;

use backend\modules\user\models\forms\LoginForm;
use Yii;
use yii\filters\AccessControl;
use backend\components\web\Controller;

class LoginController extends Controller
{
	/** @var string */
	public $defaultAction = 'login';
	/** @var string */
	public $layout = '@backend/views/layouts/login_main';

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'actions' => ['login'],
						'allow'   => true,
					],
				],
			],
		];
	}

	/**
	 * Login action
	 * @return string|\yii\web\Response
	 */
	public function actionLogin()
	{
		if (!\Yii::$app->user->isGuest) {
			return $this->goHome();
		}

		$model = new LoginForm();
		if ($model->load(Yii::$app->request->post()) && $model->login()) {
			return $this->goBack();
		} else {
			return $this->render('login', [
				'model' => $model,
			]);
		}
	}
}