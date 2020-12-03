<?php

namespace OMerz\HeroADM\Http\Middleware;

use Closure;
use OMerz\HeroADM\HEROConfig as Config;
class isHEROAdmin
{
    protected $roleadmin;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $configs = new Config;
        if(!auth()->user()){
            return redirect(route('heroadm.login'));
        }

        $autho = in_array(auth()->user()->role, explode('|', $configs->get('roles_see_heroadm')));

        if(!$autho){
            return redirect(route('heroadm.login'));
        }

        return $next($request);
    }
}
