<?php

namespace App\LittleADM\Http\Middleware;

use Closure;
use App\LittleADM\LADConfig as Config;
class isLADAdmin
{
    protected $roleadmin = "admin";
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
            return redirect(route('littleadm.login'));
        }

        $autho = in_array(auth()->user()->role, explode('|', $configs->get('roles_see_littleadm')));

        if(!$autho){
            return redirect(route('littleadm.login'));
        }

        return $next($request);
    }
}
