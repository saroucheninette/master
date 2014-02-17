<?php
namespace App\Models;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;


class Users extends BaseModel implements UserInterface, RemindableInterface {
    protected $table = 'Users';
    public $timestamps = false;
    protected $guarded = array('Users_id', 'Password');
    protected $guarded_histories = array('DateLastLogOn','DateLastLogOff');
    protected $primaryKey = 'Users_id';

    public function getAuthIdentifier() {
        return $this->getKey();
    }

    public function getAuthPassword() {
        return $this->Password;
    }

    public function getReminderEmail() {
        return $this->Email;
    }
    
    public function __toString() {
        return $this->FirstName.' '.$this->LastName;
    }
   
}
