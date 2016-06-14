<?php

use yii\db\Migration;

class m160614_090541_oauth extends Migration
{
    public function up()
    {
        $this->createTable('auth',[
            'id' => $this->primaryKey(11),
            'user_id' => $this->integer(),
            'token' => $this->string(255)->notNull(),
            'type' => $this->integer(1),
            'token_secret' => $this->string(255)
        ]);

       $this->addForeignKey('auth_user_id_fk','auth','user_id','user','id','CASCADE','NO ACTION');
    }

    public function down()
    {
        $this->dropForeignKey('auth_user_id_fk','auth');
        $this->dropTable('auth');
    }

}
