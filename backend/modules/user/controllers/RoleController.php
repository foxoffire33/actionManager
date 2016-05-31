<?php

namespace backend\modules\user\controllers;


use backend\components\web\Controller;
use backend\modules\user\models\search\RoleSearch;
use backend\modules\user\Module;
use Yii;
use backend\modules\user\models\Role;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class RoleController extends Controller
{

	/**
	 * Lists all Tag models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new RoleSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel'  => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single User model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		$model = $this->findModel($id);

		return $this->render('view', [
			'model' => $model,
		]);
	}

	/**
	 * Creates a new User model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Role(['type' => 1]);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		}

		return $this->render('create', [
			'model' => $model,
		]);
	}

	/**
	 * Updates an existing User model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		}

		return $this->render('update', [
			'model' => $model,
		]);
	}

	/**
	 * Deletes an existing Tag model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 * @throws ForbiddenHttpException
	 * @throws NotFoundHttpException
	 * @throws \Exception
	 */
	public function actionDelete($id)
	{
		if ($id != 'admin') {
			$this->findModel($id)->delete();
			return $this->redirect(['index']);
		}

		throw new ForbiddenHttpException(Module::t('user', 'It\'s not possible to delete the admin'));
	}

	/**
	 * Finds the Role model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Role the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Role::findOne(['name' => $id])) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}