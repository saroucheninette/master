<?php
namespace App\Models;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use \Illuminate\Support\Facades\Validator;

class TicketTypes extends BaseModel {
    protected $table = 'TicketTypes';
    public $timestamps = false;
    protected $guarded = array('TicketTypes');
    protected $primaryKey = 'TicketTypes_id';
    
}
