<?php
namespace App\Models;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use \Illuminate\Support\Facades\Validator;

class TicketRollbackstates extends BaseModel {
    protected $table = 'TicketRollbackstates';
    public $timestamps = false;
    protected $guarded = array('RollbackStates_id');
    protected $primaryKey = 'RollbackStates_id';
    
}
