<?php
namespace App\Utils;

/**
 * Classe de gestion des listes
 */
class CompareUtil {
   
   
    public static function Equals($obj1,$obj2)
    {
        //Text ?
        if($obj1 == $obj2) return true;
        //Date ?
        if(strtotime($obj1)!==false)
        {
            if(strtotime($obj1)===strtotime($obj2)) return true;
        }
        
        return false;
    }

}
   
 
