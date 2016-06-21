<?php

use yii\db\Migration;
use common\models\User;
class m160621_102003_changes extends Migration
{
    public function up()
    {
        $this->dropColumn(User::tableName(),'username');
    }

    public function down()
    {
        $this->addColumn(User::tableName(),'username','VARCHAR(255) AFTER `id`');
    }
    
}
