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
    public static function ConvertToDateTime($dateTimeStr)
    {
        if(empty($dateTimeStr)) return '';
        return \DateTime::createFromFormat('Y-m-d H:i:s.u', $dateTimeStr);
    }
    public static function ConvertDateForShow($dateTimeStr)
    {
        if(empty($dateTimeStr)) return '';
        $dateTime = self::ConvertToDateTime($dateTimeStr);
        if(empty($dateTime)) return '';
        return $dateTime->format('Y-m-d');
    }
     public static function ConvertDateTimeForShow($dateTimeStr)
    {
        if(empty($dateTimeStr)) return '';
        $dateTime = self::ConvertToDateTime($dateTimeStr);
        if(empty($dateTime)) return '';
        return $dateTime->format('Y-m-d H:i:s');
    }
    
}
   
 
