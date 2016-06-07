<?php

use yii\db\Migration;

class m160606_103746_Oauth extends Migration
{
    public function up()
    {
        $this->createTable('token',[
            'user_id' => $this->integer(11)->notNull(),
            'code' => $this->string(32)->notNull(),
            'access_token' => $this->string(255),
            'access_token_expires' => $this->integer(),
            'type' => $this->integer(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->createIndex('token_unique', 'token', ['user_id', 'code', 'type'], true);
        $this->addForeignKey('fk-auth-user_id-user-id','token','user_id','user','id','CASCADE','NO ACTION');
    }
    public function down()
    {
        $this->dropForeignKey('fk-auth-user_id-user-id','token');
        $this->dropTable('token');
    }
}
