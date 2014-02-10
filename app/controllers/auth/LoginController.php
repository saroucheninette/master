<?php
namespace App\Controllers;

use \Illuminate\Support\MessageBag;
use \Illuminate\Support\Facades\View;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Redirect;
use \Illuminate\Support\Facades\Lang;
use \App\Models\Users;

class LoginController extends BaseController {
    protected $layout = "layouts.auth";

    /****
     * Index page
     */
    public function index() {
        return View::make('layouts.auth'); 
    }
    /****
     * Login user
     */
    public function login() {
        $username = $_POST["username"];
        $password = $_POST["password"];
        if (Auth::attempt(array('Alias' => $username, 'Password' => $password)))
        {
            $user =  \App\Models\Users::find(Auth::user()->id);
            $user->update(array('DateLastLogOn' => \App\Utils\DateUtil::DateNowString()));
            return Redirect::to('/');
        }
        else
        {
            $this->errorBag->add('error',Lang::get('auth.baduserpwd'));
            return View::make("layouts.auth")
               ->with('errors',$this->errorBag->getMessageBag()); 
        }
    }
    /****
     * Logout user
     */
     public function logout() {
         if(Auth::user())
         {
            $user =  \App\Models\Users::find(Auth::user()->id);
            $user->update(array('DateLastLogOff' => \App\Utils\DateUtil::DateNowString()));
            Auth::logout();
         }
         return Redirect::to('login');
     }
    
 
}