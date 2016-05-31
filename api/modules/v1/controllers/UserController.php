<?php
namespace api\modules\v1\controllers;

use api\modules\v1\models\LoginForm;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
	public $modelClass = 'api\v1\models\User';

	/**
	 * Enables the user to login.
	 * Requires the username and password fields to be posted
	 * @return LoginForm|string
	 */
	public function actionLogin()
	{
		$model = new LoginForm();

		if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '') && $model->login()) {
			return \Yii::$app->user->identity->getAuthKey();
		} else {
			$response = \Yii::$app->getResponse();
			$response->setStatusCode(401);
			return $model;
		}
	}
}
