<?php
namespace App\Models;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use \Illuminate\Support\Facades\Validator;

class Tickets extends BaseModel {
    protected $table = 'Tickets';
    public $timestamps = false;
    protected $guarded = array('Tickets_id','_token');
    protected $primaryKey = 'Tickets_id';
    
    protected static $rules = array(
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
    
   
}
