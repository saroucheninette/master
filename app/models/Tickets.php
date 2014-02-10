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
    
    private static $rules = array(
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
    
    public static function validate($input)
    {
        $v = Validator::make($input,self::$rules);
        return $v;
    }
   
}
