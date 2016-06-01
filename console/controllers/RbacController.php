<?php
namespace console\controllers;

use frontend\components\rbac\IsOwnerRule;
use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionIndex(){
        $auth = Yii::$app->authManager;

        $isOwnerRule = new IsOwnerRule();
        $auth->add($isOwnerRule);

        $roleMember = $auth->getRole('member');

//        $managerOrganization = $auth->createPermission('manageOrganization');
//        $managerOrganization->description = 'Mag deze gebruiker deze organization beheren';//
 //       $managerOrganization->ruleName = $isOwnerRule->name;

      //  $auth->add($managerOrganization);

      //  $auth->addChild($roleMember,$managerOrganization);

    }
}