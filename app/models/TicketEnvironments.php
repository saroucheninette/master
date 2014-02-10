<?php
namespace App\Models;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use \Illuminate\Support\Facades\Validator;

class TicketEnvironments extends BaseModel {
    protected $table = 'TicketEnvironments';
    public $timestamps = false;
    protected $guarded = array('TicketEnvironments');
    protected $primaryKey = 'Environments_id';
    
}
