<?php

namespace backend\modules\user\controllers;

use backend\modules\user\models\forms\PasswordResetRequestForm;
use backend\modules\user\models\forms\ResetPasswordForm;
use backend\modules\user\Module;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use backend\components\web\Controller;
use yii\web\BadRequestHttpException;

class ResetController extends Controller
{
	/** @var string  */
	public $defaultAction = 'request';
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
						'actions' => ['request', 'change'],
						'allow'   => true,
					],
				],
			],
		];
	}

	/**
	 * @return string|\yii\web\Response
	 */
	public function actionRequest()
	{
		$model = new PasswordResetRequestForm();
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			if ($model->sendEmail()) {
				Yii::$app->session->setFlash('success', Module::t('reset', 'Check your email for further instructions.'));

				return $this->goHome();
			} else {
				Yii::$app->getSession()->setFlash('error', Module::t('reset', 'Sorry, we are unable to reset password for email provided.'));
			}
		}

		return $this->render('request', [
			'model' => $model,
		]);
	}

	/**
	 * @param $token
	 * @return string|\yii\web\Response
	 * @throws BadRequestHttpException
	 */
	public function actionChange($token)
	{
		try {
			$model = new ResetPasswordForm($token);
		} catch (InvalidParamException $e) {
			throw new BadRequestHttpException($e->getMessage());
		}

		if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
			Yii::$app->session->setFlash('success', Module::t('reset', 'New password was saved.'));

			return $this->goHome();
		}

		return $this->render('reset', [
			'model' => $model,
		]);
	}


}