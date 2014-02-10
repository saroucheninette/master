<?php
namespace App\Controllers;

use Illuminate\Routing\Controllers\Controller;
use \Illuminate\Support\Facades\View;
use \Illuminate\Support\MessageBag;
use \App\Controllers\PermissionController as Perm;

class BaseController extends Controller {

    protected $errorBag;
    protected $infoBag;
    protected $perm;


    public function __construct() {
        $this->errorBag = new MessageBag;
        $this->infoBag = new MessageBag;
        $this->perm = Perm::Instance();
    }
    /**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
                if ( ! is_null($this->layout))
		{
                    $this->layout = View::make($this->layout);
		}
	}
        

}