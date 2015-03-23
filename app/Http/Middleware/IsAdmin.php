<?php namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Session;

class IsAdmin extends Authenticate {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;


	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		//		var_dump(redirect()->secure());
		//die("Illuminate\Routing\Redirector    Illuminate\Http\RedirectResponse");
		//return $next($request);
		$route = $request->route();
		if ($auth = $this->auth->user())
		{
			if(Session::has('Admin'))
				return $next($request);
			$user = User::findOrFail($auth->getAuthIdentifier());
			if($user->statut == 1)
			{
				Session::put('Admin', 'Admin');
				return $next($request);
			}
			if ($route && $route->hasParameter('id'))
			{
				if ($route->getParameter('id') == "*")
					return $next($request);
				$actions = $route->getAction();
				if (array_key_exists('access', $actions) && $user->id == $route->getParameter('id'))
					return $next($request);
			}
			//return redirect()->back();
		}

		if ($request->ajax())
			return response('Unauthorized.', 401);
		//die ("bad");

		return redirect()->secure('/home')->with(["warning" => "You're not an admin you are not authorized to see this page."]);

	}

	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}


}
