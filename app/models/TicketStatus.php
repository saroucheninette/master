<?php
namespace App\Models;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use \Illuminate\Support\Facades\Validator;

class TicketStatus extends BaseModel {
    protected $table = 'TicketStatus';
    public $timestamps = false;
    protected $guarded = array('TicketStatus');
    protected $primaryKey = 'Status_id';
    
}
