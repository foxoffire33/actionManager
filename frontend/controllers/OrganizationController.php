<?php
/**
 * Created by PhpStorm.
 * User: reinier
 * Date: 01-06-16
 * Time: 10:29
 */

namespace frontend\controllers;

use common\models\Organization;
use frontend\components\web\Controller;
use yii\web\NotFoundHttpException;
use Yii;
use yii\web\UnauthorizedHttpException;

class OrganizationController extends Controller
{

   /* public function actionIndex()
    {
        if(!Yii::$app->user->can('member')) {
            return $this->render('view', ['model' => $this->loadModel($id)]);
        }
        throw new UnauthorizedHttpException();
    }

    private function loadModel($id)
    {
        if (!empty(($model = Organization::findOne($id))) && Yii::$app->user->can('manageOrganization', ['userID' => $model->organization_user])) {
            return $model;
        }
        throw new NotFoundHttpException();
    }
    }
*/
}