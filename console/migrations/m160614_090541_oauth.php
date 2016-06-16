<?php

use yii\db\Migration;

class m160614_090541_oauth extends Migration
{
    public function up()
    {
        $this->createTable('token',[
            'id' => $this->primaryKey(11),
            'user_id' => $this->integer(),
            'token' => $this->string(255)->notNull(),
            'type' => $this->integer(1),
            'token_secret' => $this->string(255),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

       $this->addForeignKey('auth_user_id_fk','token','user_id','user','id','CASCADE','NO ACTION');
    }

    public function down()
    {
        $this->dropForeignKey('auth_user_id_fk','token');
        $this->dropTable('token');
    }

}
