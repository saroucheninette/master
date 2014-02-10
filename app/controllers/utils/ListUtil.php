<?php
namespace App\Utils;

/**
 * Classe de gestion des listes
 */
class ListUtil {
   
    protected static $labelKey = 'Label';
    /**
     * Retourne une liste pour création d'un <select>
     * @param object/string $object : init class de la liste ou STRING
     * @return array
     */
    public static function GetSelectList($object)
    {
        if(empty($object)) return array();
        if(is_string($object))
        {
            switch (strtoupper($object))
            {
                case 'YESNO':
                    return array(   '0' => trans('model.no'),
                                    '1' => trans('model.yes'));
                default:
                    return array();
                      
            }
        }
        else
        {
            $class = get_class($object);
            $list = $class::all();
            $primaryKey = $object->getPrimaryKey();

            $arr = array();
            $arr[""] = trans('messages.choose');
            for($i=0;$i<count($list);$i++)
            {
                $arr[$list[$i][$primaryKey]] = $list[$i][self::$labelKey];
            }
            return $arr;
        }
        
    }

}
   
 
