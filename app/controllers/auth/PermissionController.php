<?php
namespace App\Controllers;

use \Illuminate\Support\MessageBag;
use \Illuminate\Support\Facades\View;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Redirect;
use \Illuminate\Support\Facades\Lang;

class PermissionController {
   
    const READ_INDEX =0;
    const OWN_INDEX =1;
    const ADD_INDEX =2;
    const MODIFY_INDEX =3;
    const DELETE_INDEX =4;
    
    private static $profile;
    private static $PERM;
    
    private function __construct() {
        //Récupère les éléments de profile
        if(Auth::user())
        {
            self::$profile = \App\Models\Profiles::find(Auth::user()->profile);
        }
    }
    public static function Instance()
    {
        if(empty(self::$PERM))
        {
            self::$PERM = new PermissionController();
        }
        return self::$PERM;
        
    }
    
    /**
     * Peut lire une liste d'objets de type modeltype ?
     * @param type $modeltype
     */
    public static function CanRead($modeltype)
    {
        if(empty(self::$profile))
        {
            throw new \Exception("Profiles_id ".Auth::user()->profile." not found in database.");
        }
        $perms = self::getPerms($modeltype);
        return self::haveRight(self::READ_INDEX, $perms);
    }
    /**
     * Peut accéder en lecture/ecriture sur ces éléments
     * @param type $modeltype
     */
    public static function CanOwn($modeltype)
    {
        if(empty(self::$profile))
        {
            throw new \Exception("Profiles_id ".Auth::user()->profile." not found in database.");
        }
        $perms = self::getPerms($modeltype);
        return self::haveRight(self::OWN_INDEX, $perms);
    }
    /**
     * Peut ajouter des éléments
     * @param type $modeltype
     */
    public static function CanAdd($modeltype)
    {
        if(empty(self::$profile))
        {
            throw new \Exception("Profiles_id ".Auth::user()->profile." not found in database.");
        }
        $perms = self::getPerms($modeltype);
        return self::haveRight(self::ADD_INDEX, $perms);
    }
    /**
     * Peut modifier des éléments
     * @param type $modeltype
     */
    public static function CanModify($modeltype)
    {
        if(empty(self::$profile))
        {
            throw new \Exception("Profiles_id ".Auth::user()->profile." not found in database.");
        }
        $perms = self::getPerms($modeltype);
        return self::haveRight(self::MODIFY_INDEX, $perms);
    }
    /**
     * Peut supprimer des éléments
     * @param type $modeltype
     */
    public static function CanDelete($modeltype)
    {
        if(empty(self::$profile))
        {
            throw new \Exception("Profiles_id ".Auth::user()->profile." not found in database.");
        }
        $perms = self::getPerms($modeltype);
        return self::haveRight(self::DELETE_INDEX, $perms);
    }

    /**
     * Récupere le string contenant la liste des permissions pour le model
     * @param type $modeltype : model de permission(table concernée)
     * TICKET,DOCUMENT,USER,PROFILE,GROUP,HISTORY,HOST,COMMENT,ADMIN
     */
    private static function getPerms($modeltype)
    {
        switch(strtoupper($modeltype))
        {
            case 'TICKET':
                return self::$profile->TicketPermissions;
            case 'DOCUMENT':
                return self::$profile->DocumentPermissions;
            case 'USER':
                return self::$profile->UserPermissions;
            case 'PROFILE':
                return self::$profile->ProfilePermissions;
            case 'GROUP':
                return self::$profile->GroupPermissions;
            case 'HISTORY':
                return self::$profile->HistoryPermissions;
            case 'HOST':
                return self::$profile->HostPermissions;
            case 'COMMENT':
                return self::$profile->CommentPermissions;
            case 'ADMIN':
                return self::$profile->AdminPermissions;
            default:
               throw new \Exception($modeltype.' is not a valid model type. Valid models are : TICKET,DOCUMENT,USER,PROFILE,GROUP,HISTORY,HOST,COMMENT,ADMIN');
        }
    }
    /**
     * Récupère un boolean contenant la permission demandée
     * @param type $index : index de permission
     * @param type $perms : string contenant la liste des permissions
     */
    private static function haveRight($index,$perms)
    {
        $tab = explode(';', $perms);
        return $tab[$index]==1?TRUE:FALSE;
    }
   
 
}