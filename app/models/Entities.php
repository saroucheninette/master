<?php
namespace App\Models;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;


class Entities extends BaseModel {
    protected $table = 'Entities';
    public $timestamps = false;
    protected $guarded = array('Entities_id');
    protected $primaryKey = 'Entities_id';


    public function __toString() {
        return $this->Name;
    }
   
}
