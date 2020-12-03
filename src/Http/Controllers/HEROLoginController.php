<?php

namespace OMerz\HeroADM\Http\Controllers;


use DateTime;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use OMerz\HeroADM\HEROConfig as Config;
use OMerz\HeroADM\Configs\Config as FixC;

class HEROLoginController extends Controller
{
    protected $roleadmin = "admin";
    protected $configs;

    public function __construct(){
        $this->configs = new Config;
        $this->configsf = new FixC;
        $this->authc = $this->configsf->find('auth');
    }

    public function loginv(){
        if($this->configs->get('role_cont_configs', 'DEFDEF') == "DEFDEF"){
            session()->flash('confirm', ['title' => 'Installing LittleADM', 'route' => 'heroadm.install']);
        }
        return view('heroadm.views.auth.login');
    }

    public function logout(){
        auth()->logout();
        return redirect(route('heroadm.logout'));
    }

    public function login(Request $req){
        if(auth()->user() && in_array(auth()->user()->role, explode('|', $this->configs->get('roles_see_heroadm')))){
            return redirect(route('heroadm.dashboard'));
        }

        $authparams = $this->authc;

        $resu = 0;

        $req->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $crd = $req->only('email', 'password');

        if($authparams['driver'] == 'role'){
            foreach (explode('|', $this->configs->get('roles_see_heroadm')) as $rrr) {
                $resu = $resu + User::where("email", $req->email)->where("role", $rrr)->get()->count();
            }
        }else{
            foreach ($authparams['models'] as $key => $val) {
                $resu = $resu + app($val)->where("email", $req->email)->get()->count();
            }
        }

        if($resu){
            if($authparams['driver'] == 'role'){
                if(auth()->guard()->attempt($crd)){
                    return redirect(route('heroadm.dashboard'));
                }
            }else if($authparams['driver'] == 'mc'){
                foreach ($authparams['models'] as $key => $val) {
                    if(auth()->guard($key)->attempt($crd)){
                        return redirect(route('heroadm.dashboard'));
                    }
                }
            }

            return redirect()->back()->with([
                'error' => ['Invalid Login!']
            ]);
        }else{
            return redirect()->back()->with([
                'error' => ['Invalid Login!']
            ]);
        }

        return redirect()->back();
    }
}
