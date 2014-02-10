<?php
namespace App\Controllers;

use \Illuminate\Support\MessageBag;
use \Illuminate\Support\Facades\View;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Redirect;
use App\Controllers\PermissionController as Perm;


class HomeController extends BaseController {
    protected $layout = "index";
    
    
    public function index() {
        Perm::Instance()->CanRead('ticket');
        return View::make('index'); 
    }
    
  
 
}