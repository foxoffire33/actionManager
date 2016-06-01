<?php

namespace frontend\controllers;

use common\components\helpers\FileHelper;
use common\models\Action;
use common\models\ActionFields;
use common\models\search\ActionSearch;
use Yii;
use yii\base\Model;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * ActionController implements the CRUD actions for Action model.
 */
class ActionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Action models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Action model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    /**
     * Finds the Action model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Action the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Action::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new Action model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Action();

        $postActionFields = Yii::$app->request->post('ActionFields',[]);
        $actionFieldsModels = [];
        for ($i = 0; $i < count($postActionFields); $i++) {
            $actionFieldsModels[] = new ActionFields();
        }
        if ($model->load(Yii::$app->request->post()) && Model::loadMultiple($actionFieldsModels, ['ActionFields' => $postActionFields])) {
            if (($model->validate() && Model::validateMultiple($actionFieldsModels))) {
                $model = $this->upload($model);
                if ($model->save(false)) {
                    foreach ($actionFieldsModels as $actionField) {
                        $actionField->action_id = $model->id;
                        $actionField->save(false);
                    }
                    return $this->redirect(['view', 'id' => $model->id]);
                }else{
                    var_dump($model->errors);exit;
                }
            }
        } else {
            $actionFieldsModels = $model->actionFields;
        }
        return $this->render('create', ['model' => $model, 'actionFields' => $actionFieldsModels]);

    }

    private function upload($model)
    {
        $model->image = UploadedFile::getInstance($model, 'image');
        $imageRedom = FileHelper::redomName($model->image->baseName, $model->image->extension);
        $model->image->saveAs($imageRedom);
        $model->image = array_pop((array_slice(explode('/', $imageRedom), -1)));

        $model->image_facebook = UploadedFile::getInstance($model, 'image_facebook');
        $imageFacebookRedom = FileHelper::redomName($model->image_facebook->baseName, $model->image_facebook->extension);
        $model->image_facebook->saveAs($imageFacebookRedom);
        $model->image_facebook = array_pop((array_slice(explode('/', $imageFacebookRedom), -1)));

        $model->image_twitter = UploadedFile::getInstance($model, 'image_twitter');
        $imageTwitterRedom = FileHelper::redomName($model->image_twitter->baseName, $model->image_twitter->extension);
        $model->image_twitter->saveAs($imageTwitterRedom);
        $model->image_twitter = array_pop((array_slice(explode('/', $imageTwitterRedom), -1)));

        return $model;
    }

    /**
     * Updates an existing Action model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if(Yii::$app->request->isPost){
            $postActionFields = Yii::$app->request->post('ActionFields',[]);
            $actionFieldsModels = [];
            for ($i = 0; $i < count($actionFieldsModels); $i++) {
                $newActionFieldsModels[] = new ActionFields();
            }
            if ($model->load(Yii::$app->request->post()) && Model::loadMultiple($actionFieldsModels, $postActionFields)) {
                if (($model->validate() && Model::validateMultiple($actionFieldsModels))) {
                    $model = $this->upload($model);
                    if ($model->save(false)) {
                        foreach ($actionFieldsModels as $actionField) {
                            $actionField->action_id = $model->id;
                            $actionField->save(false);
                        }
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
            }
        } else {
            $actionFieldsModels = $model->actionFields;
        }
        return $this->render('update', ['model' => $model, 'actionFields' => $actionFieldsModels]);
    }

    /**
     * Deletes an existing Action model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

}
