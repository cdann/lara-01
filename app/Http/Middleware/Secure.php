<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Contracts\Foundation\Application;

/**
 * Secure
 * Redirects any non-secure requests to their secure counterparts.
 *
 * @param request The request object.
 * @param $next The next closure.
 * @return redirects to the secure counterpart of the requested uri.
*/
class Secure implements Middleware
{
	protected $app;

	public function __construct(Application $app)
	{
		$this->app = $app;
	}

	public function handle($request, Closure $next)
	{
		//die (var_dump($_SERVER['HTTP']));
		//$ssl = (!empty($_SERVER['HTTP']) && $_SERVER['HTTP'] == 'on') ? true:false;
		//die (var_dump($ssl));
		//$url = 'https://' . $_SERVER['SERVER_NAME'] . ':8443' . $request->getRequestUri();
//
		//if (!$ssl)
		//	return redirect()->secure($url);
		//return $next($request);
		//die($_SERVER['HTTPS']);
		//if ()
		if (!$request->secure()) {
	    		return redirect()->secure($request->getRequestUri());
		}

		return $next($request);
	}

}
