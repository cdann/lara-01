<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request as Req;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\User;

class ContactController extends Controller {

	public function get()
	{
			try
			{
			    $user = User::findOrFail(Auth::id());
			}
			catch(ModelNotFoundException $e)
			{
				return Redirect::back()->with(["error" => "l'utilisateur n'existe pas"]);
			}
			return view('contact', ['mail' => $user->email]);

	}

	public function post()
	{
	    $v = Validator::make(Request::all(), [
	        'title' => 'required|string|max:255',
	        'email' => 'required|email',
	        'content' => 'required'
	    ]);

	    if ($v->fails())
	    {
	        return  Redirect::back()->withErrors($v);
	    }

		$post = Request::all();
	    $header ='Reply-To: '.$post['email'];
		if(!mail( "celine.dannappe@gmail.com" , $post['title'] , $post['content'], $header))
			$b = "Le mail n'a pas pu etre envoyé.";
		else
			$b = "le mail a bien ete envoyé";
		return Redirect::back()->with(["success" => $b]);


	}
}
