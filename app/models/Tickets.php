<?php
namespace App\Models;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use \Illuminate\Support\Facades\Validator;

class Tickets extends BaseModel {
    protected $table = 'Tickets';
    protected $type = 'TICKET';
    public $timestamps = false;
    protected $guarded = array('Tickets_id','_token','_method');
    protected $primaryKey = 'Tickets_id';
    protected $guarded_histories = array('DescriptionHtml','ResolutionHtml','ReproductionHtml');
    protected $rules = array(
                'Name' => 'required|min:5',
                'DateStart' => 'required|date_format:"Y-m-d"',
                'DateEnd' => 'required|date_format:"Y-m-d"',
                'Status_id' => 'required',
                'Environments_id' => 'required',
                'Impacts_id' => 'required',
                'Categories_id' => 'required',
                'TicketTypes_id' => 'required',
                'IsActive' => 'required|integer',
                'IsPublic' => 'required|integer',
                'DescriptionHtml' => 'required|min:20'
                
        
            );
   
  
   public function Category()
   {
        $obj = TicketCategories::find($this->Categories_id);
        return $obj->Label;
   }
   public function Status()
   {
        $obj = TicketStatus::find($this->Status_id);
        return $obj->Label;
   }
   public function TicketType()
   {
        $obj = TicketTypes::find($this->TicketTypes_id);
        return $obj->Label;
   }
   
   public static function find($id, $columns = array('*')) {
      $ticket = parent::find($id, $columns);
      if(!empty($ticket)) {
          $ticket->DateStart = \App\Utils\DateUtil::ConvertDateForShow($ticket->DateStart);
          $ticket->DateEnd = \App\Utils\DateUtil::ConvertDateForShow($ticket->DateEnd);
      }
      return $ticket;
   }
   
   protected function before_saving() {
       if($this->Status_id=='CLO') $this->DateClosed = \App\Utils\DateUtil::DateNowString ();
       if($this->Status_id=='RES') $this->DateResolved = \App\Utils\DateUtil::DateNowString ();
   }
   
  
   
}
