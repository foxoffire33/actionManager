<?php

use yii\db\Migration;

class m160606_103746_Oauth extends Migration
{
    public function up()
    {
        $this->createTable('token', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->notNull(),
            'token' => $this->string(255),
            'token_secret' => $this->string(255),
            'type' => $this->integer(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(11),
            'created_by' => $this->integer(11),
            'deleted_at' => $this->integer()
        ]);

        $this->createIndex('token_unique', 'token', ['user_id', 'type'], true);
        $this->addForeignKey('fk-auth-user_id-user-id', 'token', 'user_id', 'user', 'id', 'CASCADE', 'NO ACTION');
    }

    public function down()
    {
        $this->dropForeignKey('fk-auth-user_id-user-id', 'token');
        $this->dropTable('token');
    }
}
