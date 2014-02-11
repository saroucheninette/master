<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

 class BaseModel extends Eloquent {
    
    protected static $rules;


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
    
    /**
     * Validate form according @rules
     * @param array $input
     * @return Validator
     */
    public static function validate($input)
    {
        $v = Validator::make($input,self::$rules);
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
   public function getDate($dateTime)
   {
       
       return \App\Utils\DateUtil::ConvertDateForShow($dateTime);
   }

    
}
