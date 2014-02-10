<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

abstract class BaseModel extends Eloquent {
    
    
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

}
