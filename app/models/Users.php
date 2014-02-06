<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Users extends Eloquent implements UserInterface, RemindableInterface {
    protected $table = 'Users';
    public $timestamps = false;
    protected $guarded = array('Users_id', 'Password');
    protected $primaryKey = 'Users_id';
//    public $incrementing = true;
    
     public function getAuthIdentifier()
    {
        return $this->getKey();
    }
    public function getAuthPassword()
    {
        return $this->Password;
    }
    public function getReminderEmail()
    {
        return $this->Email;
    }
}
