<?php

use yii\db\Migration;
use yii\helpers\ArrayHelper;

class m160531_084551_createDB extends Migration
{
    private $defaultFields;


    public function init()
    {
        $this->defaultFields = [
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer(11),
            'updated_by' => $this->integer(11),
            'deleted_at' => $this->integer()
        ];
    }
    public function up()
    {
        //create organization table
        $this->createTable('organization', ArrayHelper::merge([
            'id' => $this->primaryKey(11),
            'name' => $this->string(128)->notNull(),
            'address' => $this->string(128)->notNull(),
            'postal' => $this->string(6)->notNull(),
            'city' => $this->string(128)->notNull(),
            'logo' => $this->string(128)->notNull(),
            'organization_user' => $this->integer(11),
            'description' => $this->binary(),
        ], $this->defaultFields));



        $this->createTable('action',ArrayHelper::merge([
            'id' => $this->primaryKey(11),
            'organization_id' => $this->integer(11),
            'name' => $this->string(128)->notNull(),
            'intro' => $this->string(255)->notNull(),
            'description' => $this->text()->notNull(),
            'image' => $this->string(128)->notNull(),
            'image_facebook' => $this->string(128)->notNull(),
            'description_facebook' => $this->text(2000)->notNull(),
            'image_twitter' => $this->string(128)->notNull(),
            'description_twitter' => $this->text(140)->notNull(),
        ],$this->defaultFields));

        $this->createTable('action_fields',ArrayHelper::merge([
            'id' => $this->primaryKey(11),
            'action_id' => $this->integer(11),
            'label' => $this->string(128),
            'required' => $this->boolean()->defaultValue(false)->notNull(),
            'type' => $this->integer(1),
        ],$this->defaultFields));

        $this->createTable('action_fields_value',[
            'reaction_id' => $this->integer()->unique()->notNull(),
            'action_field_id' => $this->integer()->notNull(),
            'value' => $this->text()->notNull(),
            'ip' => $this->string(36),//IPV6 is 8 X 4 plus : er tussen
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()->notNull(),
            'deleted_at' => $this->integer(),
            'deleted_at' => $this->integer()
        ]);

        //organization
       // $this->addForeignKey('organization_created_by_fk','organization','created_by','user','id','CASCADE','NO ACTION');
        $this->addForeignKey('organization_user_id_fk','organization','organization_user','user','id','CASCADE','NO ACTION');
        //action
        $this->addForeignKey('action_created_by_fk','action','created_by','user','id','CASCADE','NO ACTION');
        $this->addForeignKey('action_updated_by_fk','action','updated_by','user','id','CASCADE','NO ACTION');
        $this->addForeignKey('action_organization_id_fk','action','organization_id','organization','id','CASCADE','NO ACTION');
        //action fields
        $this->addForeignKey('action_fields_created_by_fk','action_fields','created_by','user','id','CASCADE','NO ACTION');
        $this->addForeignKey('action_fields_updated_by_fk','action_fields','updated_by','user','id','CASCADE','NO ACTION');
        $this->addForeignKey('action_fields_action_id_fk','action_fields','action_id','action','id','CASCADE','NO ACTION');
        //action fields value
        $this->addForeignKey('action_fields_value_action_field_id_fk','action_fields_value','action_field_id','action_fields','id','CASCADE','NO ACTION');
    }
    public function down()
    {
        //organization
        $this->dropForeignKey('organization_created_by_fk','organization');
        $this->dropForeignKey('organization_updated_by_fk','organization');
        //action
        $this->dropForeignKey('action_created_by_fk','action');
        $this->dropForeignKey('action_updated_by_fk','action');
        $this->dropForeignKey('action_organization_id_fk','action');
        //action fields
        $this->dropForeignKey('action_fields_created_by_fk','action_fields');
        $this->dropForeignKey('action_fields_updated_by_fk','action_fields');
        $this->dropForeignKey('action_fields_action_id_fk','action_fields');
        //action field value
        $this->dropForeignKey('action_fields_value_action_field_id_fk','action_fields_value');

        //drop all tables
        $this->dropTable('action_fields_value');
        $this->dropTable('action_fields');
        $this->dropTable('action');
        $this->dropTable('organization');
        return true;
    }
}
