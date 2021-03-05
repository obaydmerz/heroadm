<?php

namespace OMerz\HeroADM\Http\Controllers;

use App\User;
use OMerz\HeroADM\Modules\HEROAuth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HEROAPIController extends Controller
{
    public $ha;
    
    public function __construct(){
        $this->ha = new HEROAuth();
    }

    public function getvalues($model, Request $req){
        $idf = $this->ha->checkIdfNoAbort($req);
        $model = app("App\\Http\\Controllers\\" . ucfirst($this->model) . 'Controller');

        return $this->response()->json(["data" => $model->process()], 200);
    }
}
