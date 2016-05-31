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
            'organization_id' => $this->integer(11),
            'name' => $this->string(128)->notNull(),
            'intro' => $this->binary(2000)->notNull(),
            'description' => $this->binary()->notNull(),
            'image' => $this->string(128)->notNull(),
            'image_facebook' => $this->string(128)->notNull(),
            'description_facebook' => $this->text(63206)->notNull(),
            'image_twitter' => $this->text(128)->notNull(),
            'description_twitter' => $this->text(140)->notNull(),
            'begin' => $this->dateTime()->notNull(),
            'end' => $this->dateTime()->notNull(),
            'url' => $this->string(255)->notNull(),

        ],$this->defaultFields));

        $this->createTable('actionFields',ArrayHelper::merge([
            'id' => $this->primaryKey(11),
            'label' => $this->string(128)->notNull(),
            'required' => $this->boolean()->defaultValue(false)->notNull(),
            'type' => $this->integer(1)->defaultValue(0)->notNull(),
            'action_id' => $this->integer(11),
        ],$this->defaultFields));

        //set relations
        $this->addForeignKey('action_organization_fk','action','organization_id','organization','id','CASCADE','NO ACTION');
        $this->addForeignKey('actionFields_action_fk','actionFields','action_id','action','id','CASCADE','NO ACTION');

        }

    public function down()
    {

        //drop relations
        $this->dropForeignKey('action_organization_fk','action');
        $this->dropForeignKey('actionFields_action_fk','actionFields');
        //drop tables
        $this->dropTable('actionFields');
        $this->dropTable('action');
        $this->dropTable('organization');
        return true;
    }

}
