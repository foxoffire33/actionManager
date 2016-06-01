<?php
namespace frontend\components\rbac;

use yii\rbac\Rule;

/**
 * Checks if authorID matches user passed via params
 */
class IsOwnerRule extends Rule
{
    public $name = 'isOwner';

    public function execute($user, $item, $params)
    {
        return ($user == $params['userID']);
    }
}