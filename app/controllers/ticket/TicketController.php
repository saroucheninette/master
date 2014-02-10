<?php
namespace App\Controllers;

use \Illuminate\Support\MessageBag;
use \Illuminate\Support\Facades\View;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Redirect;
use \Illuminate\Support\Facades\Lang;
use \Illuminate\Support\Facades\Validator;
use \Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Session;
use App\Models\Tickets;


class TicketController extends BaseController {
    protected $layout = "tickets.index";
    private $model = "ticket";
    /****
     * Index page
     */
    public function index() {
        if($this->perm->CanRead($this->model))
        {
            //Liste des tickets
            $tickets = Tickets::all();
            return View::make('tickets.index')->with('tickets',$tickets);
        }
        else
        {
            return Redirect::to('/');
        }
        
    }
    /**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if($this->perm->CanAdd($this->model))
                {
                    $ticket = new Tickets();
                    $validator = Validator::make(
                        array('Name' => 'required|min:5'),
                        array('DescriptionHtml' => 'required') //TODO
                    );

                    return View::make('tickets.create')->with('ticket',$ticket)
                                                    ->with('validator',$validator);
                }
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		 if($this->perm->CanAdd($this->model))
                {
                    $validator = Tickets::validate(Input::all());

                    if ($validator->fails())
                    {
                       return Redirect::to('tickets/create')
                                ->withInput()
				->withErrors($validator);
                    }
                    else
                    {
                        $ticket = new Tickets();
                        $ticket = $ticket->getObject(Input::get());
                        $ticket->Users_id_created = Auth::user()->id;
                        $ticket->DateCreated = \App\Utils\DateUtil::DateNowString();
			$ticket->save();
                       
			// redirect
			Session::flash('message', 'Successfully created nerd!');
			return Redirect::to('tickets');
                    }


                }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
    
 
}