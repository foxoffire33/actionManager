<?php
/**
 * Created by PhpStorm.
 * User: reinier
 * Date: 01-06-16
 * Time: 11:46
 */

namespace frontend\components\web;


class ImageHelper
{

    public static function convertToBase64($imageName){
        $image = \Yii::getAlias('@uploadPath').'/'.$imageName;
        return 'data: '.mime_content_type($image).';base64,'.base64_encode(file_get_contents($image));
    }

}