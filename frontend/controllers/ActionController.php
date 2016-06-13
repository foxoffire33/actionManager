<?php

namespace frontend\controllers;

use common\models\Action;
use common\models\ActionFields;
use common\models\ActionFieldsValue;
use common\models\search\ActionSearch;
use frontend\components\authClient\FacebookHelper;
use frontend\components\facebook\Auth;
use frontend\components\twitter\TwitterAuth;
use frontend\components\web\ImageHelper;
use Yii;
use yii\base\DynamicModel;
use yii\base\Model;
use yii\db\Expression;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['landing-page'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['update', 'create', 'view', 'delete', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
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
        $facebook = new Auth();
        if (Yii::$app->request->isPost) {
            $postActionFields = Yii::$app->request->post('ActionFields', []);
            $actionFieldsModels = [];
            for ($i = 0; $i < count($postActionFields); $i++) {
                $actionFieldsModels[] = new ActionFields();
            }
            if ($model->load(Yii::$app->request->post()) && Model::loadMultiple($actionFieldsModels, ['ActionFields' => $postActionFields])) {
                if (($model->validate() && Model::validateMultiple($actionFieldsModels))) {
                    if ($model->save(false)) {
                        foreach ($actionFieldsModels as $actionField) {
                            $actionField->action_id = $model->id;
                            $actionField->save(false);
                        }
                        //share op socialMedia
                        //$this->socialMediaPost($model);
                        //redirect to view
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
            }
        } else {
            $actionFieldsModels = $model->actionFields;
        }
        return $this->render('create', ['model' => $model, 'actionFields' => $actionFieldsModels, 'facebookLoginUrl' => $facebook->getLoginUrl()]);

    }

    private function socialMediaPost($actionModel)
    {
        // if ($actionModel->post_on_facebook) {
        //     $facebook = new Auth();
        //     $facebook->post($_SERVER['HTTP_HOST'] . '/' . $actionModel->id, $actionModel->description_facebook);
        // }
        //if ($actionModel->post_on_twitter) {
        //    $twitter = new TwitterAuth();
        //    $twitter->post($_SERVER['HTTP_HOST'] . '/' . $actionModel->id, $actionModel->description_twitter, $actionModel->image_twitter);
        //}
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
        $facebook = new Auth();
        if (Yii::$app->request->isPost) {
            $postActionFields = array_values(Yii::$app->request->post('ActionFields', []));
            $actionFieldsModels = [];
            for ($i = 0; $i < count($postActionFields); $i++) {
                if (!empty($postActionFields[$i]['id'])) {
                    $actionFieldsModels[] = ActionFields::findOne($postActionFields[$i]['id']);
                } else {
                    $actionFieldsModels[] = new ActionFields();
                }
            }
            if ($model->load(Yii::$app->request->post()) && Model::loadMultiple($actionFieldsModels, ['ActionFields' => $postActionFields])) {
                if (($model->validate() && Model::validateMultiple($actionFieldsModels))) {
                    //verwijder ActionFields die niet meer in het form staan
                    if (!empty(($implode = implode(',', array_values(array_diff(ArrayHelper::getColumn($model->actionFields, 'id'), ArrayHelper::getColumn($postActionFields, 'id'))))))) {
                        ActionFields::deleteAll(new Expression('id IN (' . $implode . ')'));
                    }
                    if ($model->save(false)) {
                        foreach ($actionFieldsModels as $actionField) {
                            $actionField->action_id = $model->id;
                            $actionField->save(false);
                        }
                        //share op socialMedia
                        //$this->socialMediaPost($model);
                        //redirect to view
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
            }
        } else {
            $actionFieldsModels = $model->actionFields;
        }
        return $this->render('update', ['model' => $model, 'actionFields' => $actionFieldsModels, 'facebookLoginUrl' => $facebook->getLoginUrl()]);
    }

    public function actionLandingPage($id)
    {
        if (!empty(($model = Action::findOne($id)))) {
            $this->layout = '/landing';
            $this->view->params['organization_logo'] = ImageHelper::convertToBase64($model->organization->logo);
            $this->view->params['organization_name'] = ucfirst($model->organization->name);
            $landingPageModel = $this->setupDynapmicModel($model->actionFields);
            if ($landingPageModel->load(Yii::$app->request->post()) && $landingPageModel->validate()) {

                $query = new Query();
                $queryResult = $query->select('reaction_id')->orderBy('reaction_id DESC')->from(ActionFieldsValue::tableName())->one();
                $result = intval($queryResult['reaction_id']) + 1;
                foreach ($landingPageModel->attributes() as $attribute) {
                    $newActionFieldValue = new ActionFieldsValue();
                    $newActionFieldValue->reaction_id = $result;
                    $newActionFieldValue->action_field_id = ActionFields::findOne(['action_id' => $id, 'label' => $attribute])->id;
                    $newActionFieldValue->value = $landingPageModel->$attribute;
                    $newActionFieldValue->save();
                }
                $landingPageModel = $this->setupDynapmicModel($model->actionFields);
                Yii::$app->session->setFlash('success', Yii::t('landing', 'Thenks,'));
            }
            return $this->render('landing-page', ['model' => $model, 'landingPageModel' => $landingPageModel]);
        }
        throw new  NotFoundHttpException();
    }

    private function setupDynapmicModel($actionFields)
    {
        $model = new DynamicModel(ArrayHelper::getColumn($actionFields, function ($data) {
            return $data['label'];
        }));

        foreach ($actionFields as $actionField) {
            $model->addRule([$actionField->label], ($actionField->type == ActionFields::TYPE_TEXT ? 'string' : 'boolean'));
            if ($actionField->required) {
                $model->addRule([$actionField->label], 'required');
            }
        }
        return $model;
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
