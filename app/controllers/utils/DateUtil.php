<?php
namespace App\Utils;

/**
 * Classe de gestion des dates
 */
class DateUtil {
   
    public static function ConvertDateForDB($dateTime)
    {
        if(empty($dateTime)) return null;
        return $dateTime->format('Y-m-d H:i:s');
    }
    public static function DateNowString()
    {
        $dateTime = new \DateTime('now');
        return self::ConvertDateForDB($dateTime);
    }
}
   
 
