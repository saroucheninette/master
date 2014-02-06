<?php
namespace App\Controllers;

use \Illuminate\Support\MessageBag;
use \Illuminate\Support\Facades\View;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Redirect;

class HomeController extends BaseController {
    protected $layout = "index";
    
    
    public function index() {
        return View::make('index'); 
    }
    
  
 
}