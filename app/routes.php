<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/



//LOGIN / LOGOUT
Route::get('login', '\App\Controllers\LoginController@index');
Route::post('login', '\App\Controllers\LoginController@login');
Route::get('logout', '\App\Controllers\LoginController@logout');

//AUTH ROUTES
Route::group(array('before' => 'auth'), function()
{
    Route::get('/', '\App\Controllers\HomeController@index');
     Route::resource('tickets', '\App\Controllers\TicketController');
     /*
    Route::get('tickets', '\App\Controllers\TicketController@index');
   
    Route::get('add_ticket', '\App\Controllers\TicketController@add');
    Route::post('add_ticket', '\App\Controllers\TicketController@add_post')->before('csrf');
    */
});


