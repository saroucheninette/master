<?php
namespace App\Models;
use \Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Support\Facades\Validator;
use \Illuminate\Support\Facades\DB;

 class BaseModel extends Eloquent {
    
     //Constantes
     const CREATE_ACTION = 'CREATE';
     const UPDATE_ACTION = 'UPDATE';
     const DELETE_ACTION = 'DELETE';
     
     //Règle de validation
    protected $rules;
    //Liste des champs qui empêche de générer un historique
    protected $guarded_histories = array();


    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }
  /**
   * Get BaseModel from Input:get() / array
   * @param array $array_values
   */
    public function getObject($array_values)
    {
        
        foreach ($array_values as $key => $value)
        {
            if(!in_array($key,$this->guarded))
            {
                $this->$key = $value;
            }
        }
        $this->IsDeleted=0;
        return $this;
    }
    
    public function getId()
    {
        $arr = $this->toArray();
        return $arr[$this->primaryKey];
    }
    
    /**
     * Validate form according @rules
     * @param array $input
     * @return Validator
     */
    public function validate($input)
    {
        $v = Validator::make($input,$this->rules);
        return $v;
    }
    
   /**
    * Récupère l'utilisateur
    * @param type $id
    * @return type
    */
   public function getUser($id)
   {
      $user = Users::find($id);
      return $user;
   }
   /**
    * Convertit un DateTime en un string de Date simple
    * @param DateTime $dateTime
    * @return String
    */
   public function getDate($dateTime)
   {
       return \App\Utils\DateUtil::ConvertDateForShow($dateTime);
   }
   
   /**
    * Convertit un DateTime en un string de DateTime formaté
    * @param DateTime $dateTime
    * @return String
    */
   public function getDateTime($dateTime)
   {
       return \App\Utils\DateUtil::ConvertDateTimeForShow($dateTime);
   }
   
   /**
    * Overide la fonction save afin de prendre en compte l'historique, les dates, les users
    * @param array $options
    */
   public function save(array $options = array()) {
      
       //MAJ des dates de création + modif + utilisateurs
       $user=\Illuminate\Support\Facades\Auth::user();
       $user_id=1; //system
       $action='';
       if(!empty($user)) $user_id=$user->id;
       if(empty($this->DateCreated))
       {
           $this->DateCreated = \App\Utils\DateUtil::DateNowString();
           $this->Users_id_created = $user_id;
           $action=BaseModel::CREATE_ACTION;
       }
       else {
           $this->DateUpdated = \App\Utils\DateUtil::DateNowString();
           $this->Users_id_updated = $user_id;
           $action=BaseModel::UPDATE_ACTION;
       }
       //Avant de sauvegarder
       $this->before_saving();
       
       //Suppression des clés vides sauf IsDeleted: evite les foreign keys
       foreach ($this->attributes as $key=>$value)
       {
           if(empty($value) && $key <> 'IsDeleted') unset($this->attributes[$key]);
       }
       $saved_attributes = $this->attributes;
       $saved_original = $this->original;
       
      

        //Sauvegarde de base
        $saved = parent::save($options);
       
        //Création de l'historique
        if($saved==true && $this->type <> 'HISTORY')
        {
            $this->createHistory($saved_original, $saved_attributes,$action,$this->getId());
        }
   }
   
   /**
    * Overide de la fonction delete afin de prendre en compte l'historique
    */
   public function delete() {
       $id=$this->getId();
       //Suppression de base
       parent::delete();
       
       //Save history
       $this->createHistory(array(), array(),BaseModel::DELETE_ACTION,$id);
   }
   
   /**
    * Fonction qui permet de mettre un objet à la poubelle
    */
   public function trash() {
       $this->IsDeleted = 1;
       $this->save();
   }
   
   /**
    * Fonction qui permet de récupérer la dernière requête SQL
    */
   public function getLastQuery()
   {
       $queries = DB::getQueryLog();
       $last_query = end($queries); 
       return $last_query;
   }
   
    /**
     * Création de l'historique
     * @param array $old_values : Tableau des anciennes valeurs
     * @param array $new_values : Tableau des nouvelles valeurs
     * @param const $action : Action opérée : CREATE/UPDATE/DELETE
     * @param int $id : ID concerné
     */
   public function createHistory($old_values,$new_values,$action,$id)
   {
       $user=\Illuminate\Support\Facades\Auth::user();
       $user_id=1; //system
       $guarded = array('DateUpdated','DateCreated','Users_id_created','Users_id_updated');
        if($action==BaseModel::CREATE_ACTION)
        {
             $history = new Histories();
             $history->External_id = $id;
             $history->ExternalTypes_id = $this->type;
             $history->Field = 'ALL';
             $history->Actions = $action;
             $history->Old_value = '';
             $history->New_value = '';
             $history->HistoryText = trans('messages.create_action').$this->table;
             $history->IsDeleted = 0;
             $history->IsActive = 1;
             $history->IsPublic = 1;
             $this->DateCreated = \App\Utils\DateUtil::DateNowString();
             $this->Users_id_created = $user_id;
        }
        if($action==BaseModel::UPDATE_ACTION)
        {
            foreach ($new_values as $key=>$value)
            {
                  //Création de l'historique
                  if(\App\Utils\CompareUtil::Equals($old_values[$key],$value) == false
                          && !in_array($key, $guarded)
                          && !in_array($key, $this->guarded_histories))
                  {
                    $history = new Histories();
                    $history->External_id = $id;
                    $history->ExternalTypes_id = $this->type;
                    $history->Field = $key;
                    $history->Actions =$action;
                    $history->Old_value = $old_values[$key];
                    $history->New_value = $value;
                    $history->HistoryText = trans('messages.update_action').$this->table.' #'.$id;
                    $history->IsDeleted = 0;
                    $history->IsActive = 1;
                    $history->IsPublic = 1;
                    $this->DateCreated = \App\Utils\DateUtil::DateNowString();
                    $this->Users_id_created = $user_id;

                    $history->save();
                  }
           }
        }
        if($action==BaseModel::DELETE_ACTION)
        {
             $history = new Histories();
             $history->External_id = $id;
             $history->ExternalTypes_id = $this->type;
             $history->Field = 'ALL';
             $history->Actions = $action;
             $history->Old_value = '';
             $history->New_value = '';
             $history->HistoryText = trans('messages.delete_action').$id;
             $history->IsDeleted = 0;
             $history->IsActive = 1;
             $history->IsPublic = 1;
             $this->DateCreated = \App\Utils\DateUtil::DateNowString();
             $this->Users_id_created = $user_id;
        }
   }
   
   /**
    * Fonction appelé avant d'enregistrer l'élément
    * Permet de changer certains champs particulier
    */
   protected function before_saving()
   {
       
   }
   
   
   
 /*  public static function boot() {
       parent::boot();
       //Before creation
        static::creating(function($obj)
        {
               $obj->DateCreated = \App\Utils\DateUtil::DateNowString();
               $obj->Users_id_created = \Illuminate\Support\Facades\Auth::user()->id;
        });
        //After creation
        static::created(function($obj)
        {
            
        });
        //Before update
        static::updating(function($obj)
        {
           
       
               $obj->DateUpdated = \App\Utils\DateUtil::DateNowString();
               $obj->Users_id_updated = \Illuminate\Support\Facades\Auth::user()->id;

        });
        //After update
        static::updated(function($obj)
        {
            
        });
   }*/

   
   
    
}
