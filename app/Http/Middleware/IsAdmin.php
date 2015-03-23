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
		$route = $request->route();
		if ($auth = $this->auth->user())
		{
			if(Session::has('Admin'))
				return $next($request);

			if ($route && $actions = $route->getAction() )
			{
				if (array_key_exists('access', $actions))
				{
					if (array_key_exists('id', $actions) && $auth->getAuthIdentifier() == $route->getParameter('id'))
						return $next($request);
				}
				$actions = $route->getAction();
			}
		}
		$actions = $route->getAction();


		if ($request->ajax())
			return response('Unauthorized.', 401);

		return redirect()->secure('/')->with(["error" => "You're not an admin you are not authorized to see this page."]);

	}

	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}


}
