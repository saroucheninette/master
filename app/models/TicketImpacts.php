<?php
namespace App\Models;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use \Illuminate\Support\Facades\Validator;

class TicketImpacts extends BaseModel {
    protected $table = 'TicketImpacts';
    public $timestamps = false;
    protected $guarded = array('TicketImpacts');
    protected $primaryKey = 'Impacts_id';
    
}
