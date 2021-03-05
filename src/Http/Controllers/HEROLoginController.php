<?php

namespace OMerz\HeroADM\Http\Controllers;


use DateTime;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use OMerz\HeroADM\Modules\HEROConfig as Config;

class HEROLoginController extends Controller
{
    protected $configs;

    public function __construct(){
        $this->configs = new Config;
    }

    public function loginv(){
        return view('heroadm.views.auth.login');
    }

    public function logout(){
        auth()->logout();
        return redirect(route('heroadm'));
    }

    public function login(Request $req){
        if(auth()->user() && in_array(auth()->user()->role, explode('|', $this->configs->get('roles_see_heroadm')))){
            return redirect(route('heroadm.dashboard'));
        }

        $resu = 0;

        $req->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $crd = $req->only('email', 'password');

        foreach (explode('|', $this->configs->get('roles_see_heroadm')) as $rrr) {
            $resu = $resu + User::where("email", $req->email)->where("role", $rrr)->get()->count();
        }

        if($resu){
            if(auth()->guard()->attempt($crd)){
                return redirect(route('heroadm.dashboard'));
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
