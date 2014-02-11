<?php
namespace App\Models;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use \Illuminate\Support\Facades\Validator;

class TicketCategories extends BaseModel {
    protected $table = 'TicketCategories';
    public $timestamps = false;
    protected $guarded = array('TicketCategories');
    protected $primaryKey = 'Categories_id';

    public function __toString() {
       $this->Label;
    }
   
}
