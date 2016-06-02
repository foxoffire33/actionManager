<?php
namespace frontend\components\di;

class ChangeAttributeLabelsForDynamicModel extends \yii\base\Object
{
    protected function attributeLabels(){
        return ['yoman' => 'test'];
    }
}