<?php

namespace OMerz\HeroADM\Http\Controllers;

use App\User;
use OMerz\HeroADM\Modules\HEROAuth;
use OMerz\HeroADM\Model\Heromodel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HEROCRUDRouterController extends Controller
{
    protected $cont;
    protected $path;
    
    public function construct($model){
        if($mo = Heromodel::where("name", ucfirst(model))){

        }else{
            abort(404, "CRUD Not Founded");
        }

        $this->path = "App\\Http\\Controllers\\HeroControllers\\" + ucfisrt($model) + "Controller";

        if(class_exists($this->path)){
            $this->cont = app($this->path);
        }else{
            $this->cont = app("OMerz\\HeroADM\\Http\\Controllers\\HEROCrudController");
        }

        $this->cont->constractable($mo);
    }

    public function create($model){
        $this->construct($model);
        return $this->cont->create();
    }

    public function store($model, Request $req){
        $this->construct($model);
        return $this->cont->store($model);
    }

    public function edit($model, $id){
        $this->construct($model);
        return $this->cont->edit($id);
    }

    public function update($model, $id, Request $req){
        $this->construct($model);
        return $this->cont->update($req, $id);
    }

    public function destroy($model, $id){
        $this->construct($model);
        return $this->cont->update($id);
    }

    public function relation($model, Request $req){
        $this->construct($model);
        return $this->cont->relation($req);
    }

    public function relationmany($model, Request $req){
        $this->construct($model);
        return $this->cont->relationmany($req);
    }
}
