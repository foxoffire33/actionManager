<?php

use yii\db\Migration;
use yii\helpers\ArrayHelper;

class m160530_120040_createDB extends Migration
{

    private $defaultFields;

    public function init()
    {
        $this->defaultFields = [
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
            'created_by' => $this->integer(11)->notNull(),
            'updated_by' => $this->integer(11)->notNull(),
            'deleted' => $this->boolean()->defaultValue(false)->notNull()
        ];
    }

    public function up()
    {
        //create organization table
        $this->createTable('organization', ArrayHelper::merge([
            'id' => $this->primaryKey(11),
            'name' => $this->string(128)->notNull(),
            'adres' => $this->string(128)->notNull(),
            'postal' => $this->string(6)->notNull(),
            'city' => $this->string(128)->notNull(),
            'logo' => $this->string(128)->notNull(),
            'description' => $this->binary(),
        ], $this->defaultFields));


        //create action table and link action to a organization
        //create table
        $this->createTable('action',ArrayHelper::merge([
            'id' => $this->primaryKey(11),
            'name' => $this->string(128)->notNull(),
            'intro' => $this->binary(2000),
            'description' => $this->binary(),
            'image' => $this->string(128),
            'image_facebook' => $this->string(128),
            'description_facebook' => $this->binary(2000),
            'image_twitter' => $this->texz(128),
            'description_twitter' => $this->text(140),

        ],$this->defaultFields));

        $this->createTable('actionFields',ArrayHelper::merge([
            'id' => $this->primaryKey(11),
            'label' => $this->string(128),
            'required' => $this->boolean()->defaultValue(false)->notNull()
        ],$this->defaultFields));

        }

    public function down()
    {
        $this->dropTable('organization');
        $this->dropTable('action');
        return true;
    }

}
