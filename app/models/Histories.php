<?php
namespace App\Models;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use \Illuminate\Support\Facades\Validator;

class Histories extends BaseModel {
    protected $table = 'Histories';
    protected $type = 'HISTORY';
    public $timestamps = false;
    protected $guarded = array('Histories_id','_token','_method');
    protected $primaryKey = 'Histories_id';
    
    protected $rules = array();
   

   public static function find($id, $columns = array('*')) {
      $ticket = parent::find($id, $columns);
      if(!empty($ticket)) {
          $ticket->DateStart = \App\Utils\DateUtil::ConvertDateForShow($ticket->DateStart);
          $ticket->DateEnd = \App\Utils\DateUtil::ConvertDateForShow($ticket->DateEnd);
      }
      return $ticket;
   }
   
}
