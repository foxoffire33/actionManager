<?php
namespace common\components\helpers;

use Yii;
use yii\web\HttpException;

/**
 * File system helper
 *
 * Help managing files on the back- and frontend of the application
 *
 */
class FileHelper extends \yii\helpers\FileHelper
{
    /**
     * @param $file_name
     * @param bool $suppress_errors
     * @throws HttpException
     */
    public static function removeFile($file_name, $suppress_errors = true)
    {
        // Check if string contains @backend
        if (strpos($file_name, '@uploadPath') !== false) {
            var_dump(str_replace('@uploadPath', '@uploadPath', $file_name));
            exit;
            self::unlink(str_replace('@uploadPath', '@uploadPath', $file_name), $suppress_errors);
        } else {
            // No backend/frontend found, error
            if (!$suppress_errors) {
                throw new HttpException('Could not find file');
            }
        }
    }

    /**
     * Actually delete the file
     * @param $file
     * @param $suppress_errors
     */
    private static function unlink($file, $suppress_errors)
    {
        $alias = Yii::getAlias($file);
        if ($suppress_errors) {
            @unlink($alias);
        } else {
            unlink($alias);
        }
    }

    public static function redomName($name, $extension)
    {
        while (file_exists(Yii::getAlias('@uploadPath') . '/' . $name . '.' . $extension)) {
            $name = rand(1000, 9000);;
        }
        return Yii::getAlias('@uploadPath') . '/' . $name . '.' . $extension;
    }

}
