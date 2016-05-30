<?php
namespace console\components;

class MigratetionHelper
{
    public static function createDatetimeFields($migratetion,$fields = ['created','updated'])
    {
        if(is_array($fields) && !empty($fields)){
            $return = [];
            foreach($fields as $field){
                $return[$field] = $migratetion->dateTime();
            }
            return $return;
        }
    }

    public static function createUserFields($migratetion,$fields = ['created_by','updated_by']){

    }


    public static function getDefaultTableFields($migratetion){

    }



}