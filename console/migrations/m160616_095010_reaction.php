<?php

use yii\db\Migration;
use common\models\ActionFields;
use common\models\ActionFieldsValue;

class m160616_095010_reaction extends Migration
{
    public function up()
    {
        $this->createTable('reaction', [
            'id' => $this->primaryKey(),
            'action_id' => $this->integer(),
            'ip' => $this->string(16),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'deleted_at' => $this->integer(),
        ]);

        $this->createIndex('unique_reaction_id_and_action_field_id_fk',ActionFieldsValue::tableName(),['reaction_id','action_field_id'],['unique']);

        $allCurrentReacties = ActionFieldsValue::find()->select('reaction_id,ip,action_field_id,value')->orderBy('reaction_id')->all();

        $currentReactionID = 0;
        $cueentNewReactionID = 0;

        foreach ($allCurrentReacties as $key=>$activeFieldValue){
            if($activeFieldValue->reaction_id != $currentReactionID) {
                $currentReactionID = $activeFieldValue->reaction_id;
                $this->insert('reaction',[
                    'action_id' => $activeFieldValue->actionField->action_id,
                    'ip' => $activeFieldValue->ip,
                    'created_at' => time(),
                    'updated_at' => time(),
                    'created_by' => 1,
                    'updated_by' => 1
                ]);
                $cueentNewReactionID = \Yii::$app->db->getLastInsertID();
            }else{
                $this->update(ActionFieldsValue::tableName(),['reaction_id' => $cueentNewReactionID],['reaction_id' =>  $activeFieldValue->reaction_id,'action_field_id' => $activeFieldValue->action_field_id]);
            }
        }

        $this->dropColumn(ActionFieldsValue::tableName(),'ip');



    }

    public function down()
    {
        $this->addColumn(ActionFieldsValue::tableName(),'ip','VARCHAR(16) AFTER `value`');

        $reactions = \common\models\Reaction::find()->asArray()->all();
        foreach ($reactions as $reaction){
            $this->update(ActionFieldsValue::tableName(),['ip' => $reaction['ip']],['reaction_id' => $reaction['id']]);
        }
        
        $this->dropTable('reaction');

    }
}
