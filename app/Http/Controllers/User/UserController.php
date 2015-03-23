<?php namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as Req;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Handle a login request to the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postLogin(Req $request)
	{
		$this->validate($request, [
			'email' => 'required|email', 'password' => 'required',
		]);

		$credentials = $request->only('email', 'password');

		if ($this->auth->attempt($credentials, $request->has('remember')))
		{
			return redirect()->secure($this->redirectPath());
		}
		return redirect()->secure($this->loginPath())
					->withInput($request->only('email', 'remember'))
					->withErrors([
						'email' => 'These credentials do not match our records.',
					]);
	}

	/**
	 * Log the user out of the application.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogout()
	{
		$this->auth->logout();

		return redirect()->secure('/');
	}

	/**
	 * Handle a registration request for the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postRegister(Req $request)
	{
		$validator = $this->registrar->validator($request->all());

		if ($validator->fails())
		{
			$this->throwValidationException(
				$request, $validator
			);
		}
		$mycreate = $request->all();

		$mycreate['password'] = bcrypt($request->input('password'));
		$this->auth->login($this->registrar->create($mycreate));

		return redirect()->secure($this->redirectPath());
	}


	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;
		$this->redirectPath = "/";
		$this->loginPath = "/";

		//$this->middleware('isAdmin');
	}

	public function seeView()
	{
		//die("hpuhpu");

		$users = User::get();
		return view('user.all', compact('users'));
	}

	public function edit($id = -1)
	{
		if ($id != -1)
		{
			try
			{
			    $user = User::findOrFail($id);
			}
			catch(ModelNotFoundException $e)
			{
				return Redirect::back()->with(["error" => "l'utilisateur n'existe pas"]);
			}
			$user = User::findOrFail($id);
		}
		else
			$user = new User;
		return view('user.edit', ['user' => $user]);
	}

	public function create()
	{
		$myuser = Request::all();
		$validator = $this->registrar->validator($myuser);
		if ($validator->fails())
		{
			$messages = $validator->messages();
			return Redirect::back()->with(["error" => $messages]);
		}
		if (Request::input('password'))
			$myuser["password"] = bcrypt($myuser['password']);
		$user = User::create($myuser);
		return Redirect::secure("/user")->with(["success" => "l'utilisateur $user->name a ete cree"]);
	}

	public function update($id, Req $request)
	{
		if ($id != -1)
		{
			try
			{
			    $user = User::findOrFail($id);
			}
			catch(ModelNotFoundException $e)
			{
				return Redirect::back()->with(["error" => "l'utilisateur n'existe pas"]);
			}
		}
		$myupdate = Request::all();
		if ($myupdate["email"] == $user->email)
			unset($myupdate["email"]);
		//die(get_class ($request));
		$validator = $this->registrar->validatorUpdate($myupdate);

		if ($validator->fails())
		{
			$messages = $validator->messages();
			/*echo "<pre>";
			var_dump($myupdate);
			echo "</pre>";
			die($messages);*/
			$this->throwValidationException(
				$request, $validator
			);
			return Redirect::back()->with(["error" => $messages]);
		}
		if (Request::input('password'))
			$myupdate["password"] = bcrypt($myupdate['password']);
		$user->update($myupdate);
		return Redirect::secure("/user")->with(["success" => "l'utilisateur $user->name a ete modifié"]);
	}

	public function delete($id)
	{
		if ($id != -1)
		{
			try
			{
			    $user = User::findOrFail($id);
			}
			catch(ModelNotFoundException $e)
			{
				return Redirect::back()->with(["error" => "l'utilisateur n'existe pas"]);
			}
			$user = User::findOrFail($id);
		}
		$name = $user->name;
		$user->delete();
		if ($id != Auth::user()->id)
			return Redirect::secure("/user")->with(["success" => "l'utilisateur $name a ete supprimé"]);
		else
			return Redirect::secure("/");
	}



}
