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
                    return View::make('tickets.create')->with('ticket',$ticket);
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
                    $ticket = new Tickets();
                    $validator = $ticket->validate(Input::all());

                    if ($validator->fails())
                    {
                       return Redirect::to('tickets/create')
                                ->withInput()
				->withErrors($validator);
                    }
                    else
                    {
                        
                        $ticket = $ticket->getObject(Input::get());
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
            $ticket = Tickets::find($id);
            return View::make('tickets.show')->with('ticket',$ticket);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
            $ticket = Tickets::find($id);
            return View::make('tickets.edit')->with('ticket',$ticket);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
            //Todo own
            if($this->perm->CanModify($this->model))
            {
                    $ticket = new Tickets();
                    $validator = $ticket->validate(Input::all());

                    if ($validator->fails())
                    {
                       return Redirect::to("tickets/$id/edit")
                                ->withInput()
				->withErrors($validator);
                    }
                    else
                    {
                        $ticket = Tickets::find($id);
                        
            
                        $ticket = $ticket->getObject(Input::get());

			$ticket->save();
                       
                        
			// redirect
			Session::flash('message', 'Successfully updated nerd!');
			return Redirect::to("tickets/$id/edit")->with('ticket',$ticket);
                    }


           }
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