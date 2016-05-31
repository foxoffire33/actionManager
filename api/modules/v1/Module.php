<?php

namespace api\modules\v1;

use yii\filters\auth\HttpBasicAuth;

class Module extends \yii\base\Module
{
	public $controllerNamespace = 'api\modules\v1\controllers';
	public $modelNamespace = 'api\modules\v1\models';

	public function init()
	{
		parent::init();

		// Disable the user session
		\Yii::$app->user->enableSession = false;
	}

	public function behaviors()
	{
		$behaviors = parent::behaviors();

		// Add the authenticator for all controllers except user
		if (\Yii::$app->controller->id !== 'user')
		{
			$behaviors['authenticator'] = [
				'class' => HttpBasicAuth::className(),
			];
		}
		return $behaviors;
	}
}
