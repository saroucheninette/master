<?php
namespace App\Models;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use \Illuminate\Support\Facades\Validator;

class TicketPriorities extends BaseModel {
    protected $table = 'TicketPriorities';
    public $timestamps = false;
    protected $guarded = array('TicketPriorities');
    protected $primaryKey = 'Priorities_id';
    
}
