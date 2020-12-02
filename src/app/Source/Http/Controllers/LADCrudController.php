<?php

namespace App\LittleADM\Http\Controllers;


use DateTime;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Support\Facades\Storage;
use App\LittleADM\Tools\Locale\LocaleTrt;
use Illuminate\Support\Facades\Hash;
use App\LittleADM\Tools\Schema\LADSchemaManager;
use App\LittleADM\LADConfig;
use App\LittleADM\Tools\ObjectComp;
use App\LittleADM\Tools\ArrayCompb;
use Illuminate\Support\Facades\Route;
use App\LittleADM\Tools\Crud;
use App\Http\Controllers\Controller;
use App\LittleADM\Permi;
use Intervention\Image\ImageManagerStatic as Image;
use App\LittleADM\Mbuilder;

use App\LittleADM\Tools\CrudDefiner\Validator;
use App\LittleADM\Tools\CrudDefiner\Pusher;


class LADCrudController extends Controller
{
    protected $rolesallowed = [];
    protected $name = "user";
    protected $configs;
    protected $class = User::class;
    protected $columns = array();
    protected $gate;

    protected function allows($action){
        Permi::abort($action, $this->rolesallowed, auth()->user()->role);
    }

    /**
     * Construct The Crud
     * @return void
    */
    public function construct($auth){

    }

    /**
     * Construct The Columns Of Crud
     * @return void
    */
    public function constructcolumns(){

    }

    /**
     * On Action
     * @return void
    */
    public function action($type, $data, $auth){

    }

    /**
     * Construct The Base Controller
     * @return void
    */
    public function __construct(){
        $this->construct(auth()->user());
        $this->constructcolumns();
        $this->configs = new LADConfig;
    }

    /**
     * Compact Datas
     * @param array $array Instance Of Array
     * @return array
    */
    protected function compacts(array $array){
        return ArrayCompb::join($array, [
            "roles" => $this->rolesallowed,
            'localetrt' => new LocaleTrt,
            'configs' => $this->configs,
            "permi" => new Permi('cover', []),
            "menuitems" => Mbuilder::all(),
            "columns" => $this->columns,
        ]);
    }

    /**
     * Simple Compact Datas
     * @param $collection
     * @param $additionaltitle
     * @return array
    */
    protected function compactsview($collection, $additionaltitle = null, $additionalvars = null){
        if($additionalvars == null){
            return $this->compacts([
                "collection" => $collection,
                'title1' => ucfirst($this->name),
                "title" => ucfirst($this->name) . ($additionaltitle != null ? ' | ' . $additionaltitle : ''),
            ]);
        } else {
            return ArrayCompb::join($this->compacts([
                "collection" => $this->collection,
                'title1' => ucfirst($this->name),
                "title" => "Crud | " . ucfirst($this->name) . ($additionaltitle != null && $additionaltitle != "" ? ' | ' . $additionaltitle : ''),
            ]), $additionalvars);
        }
    }

    /**
     * Index c(R)ud
     * @return View
    */
    public function index(){
        $this->allows($this->name . '_read');
        $this->action("READ", [], auth()->user());

        $datas = $this->compactsview($this->class->all());

        if(view()->exists('customlad.' . $this->name . '.index')){
            return view('customlad.' . $this->name . '.index', $datas);
        }

        return view('littleadm.views.crud.index', $datas);
    }

    /**
     * Create (C)rud
     * @return View
    */
    public function create(){
        $this->allows($this->name . '_create');
        $this->action("CREATE", [], auth()->user());
        $datas = $this->compactsview(null, 'Create');
        if(view()->exists('customlad.' . $this->name . '.create')){
            return view('customlad.' . $this->name . '.create', $datas);
        }

        return view('littleadm.views.crud.create', $datas);
    }

    /**
     * Store (C)rud
     * @param $req Instance of Request
     * @return Response
    */
    public function store(Request $req){
        $this->allows($this->name . '_create');
        $validator = Validator::make($this->columns);
        $push = Pusher::make($this->columns, $req, $this->name);
        $this->action("STORE", ['validator' => $validator, 'push' => $push, 'req' => $req], auth()->user());
        $req->validate($validator);

        $model = $this->class->create($push);
        foreach ($push as $key => $value) {
            $model[$key] = $value;
        }
        $model->save();

        if(Route::has('littleadm.crud.' . $this->name . '.index')){
            return redirect(route('littleadm.crud.' . $this->name . '.index'))->with([
                'success' => ['Created Successfully']
            ]);
        }

        return redirect()->back()->with([
            'success' => ['Created Successfully']
        ]);
    }

    /**
     * Edit cr(U)d
     * @param $id
     * @return View
    */
    public function edit($id){
        $this->allows($this->name . '_update');
        if($collection = $this->class->find($id)){
            $this->action("EDIT", ['id' => $id, 'model' => $collection], auth()->user());
            $datas = $this->compactsview($collection);
            if(view()->exists('customlad.' . $this->name . '.edit')){
                return view('customlad.' . $this->name . '.edit');
            }
            return view('littleadm.views.crud.edit', $datas);
        }

        return $this->index();
    }

    /**
     * Update cr(U)d
     * @param $req Instance of Request
     * @param $id
     * @return View
    */
    public function update(Request $req, $id){
        $this->allows($this->name . '_update');
        if($model = $this->class->find($id)){
            $validator = Validator::makeOnUpdate($this->columns, $req, $model);
            $push = Pusher::update($this->columns, $req, $model, $this->name);
            $this->action("UPDATE", ['validator' => $validator, 'push' => $push, 'req' => $req, 'id' => $id, 'model' => $model], auth()->user());

            $req->validate($validator);
            foreach ($push as $key => $value) {
                $model[$key] = $value;
            }
            $model->save();

            if(Route::has('littleadm.crud.' . $this->name . '.index')){
                return redirect(route('littleadm.crud.' . $this->name . '.index'))->with([
                    'success' => ['Updated Successfully']
                ]);
            }
    
            return redirect()->back()->with([
                'success' => ['Updated Successfully']
            ]);
        }

        return redirect()->back();
    }

    /**
     * Delete cru(D)
     * @param $id
     * @return Response
    */
    public function destroy($id){
        $this->allows($this->name . '_delete');
        if($model = $this->class->find($id)){
            $this->action("DELETE", ['id' => $id, 'model' => $model], auth()->user());
            $model->delete();
            foreach ($this->columns as $col) {
                switch ($col) {
                    case 'image':
                        if($model[$col->name] != $col->def){
                            Storage::delete('public/' . $this->name . '/' . $col->name . '/' . $model[$col->name]);
                        }
                        break;
                }
            }
        }

        if(Route::has('littleadm.crud.' . $this->name . '.index')){
            return redirect(route('littleadm.crud.' . $this->name . '.index'))->with([
                'success' => ['Deleted Successfully']
            ]);
        }

        return redirect()->back()->with([
            'success' => ['Deleted Successfully']
        ]);
    }

    /**
     * Truncate cr(U)d
     * @return View
    */
    public function truncate(){
        $this->allows($this->name . '_delete');
        $this->action("TRUNCATE", [], auth()->user());
        $this->class->truncate();
        if(Route::has('littleadm.crud.' . $this->name . '.index')){
            return redirect(route('littleadm.crud.' . $this->name . '.index'))->with([
                'success' => ['Truncated Successfully']
            ]);
        }

        return redirect()->back()->with([
            'success' => ['Truncated Successfully']
        ]);
    }

    /**
     * Relation c(R)ud
     * @param $req Instance of Request
     * @return Response
    */
    public function relation(Request $req){
        $tablesearched = $req->table;
        $columnshowed = $req->column;
        $this->action("RELATION", ['req' => $req, 'table' => $tablesearched, 'column' => $columnshowed], auth()->user());
        if(!isset($req->term)){
            $result = app(str_replace('+', "\\", str_replace('_', "\\", $tablesearched)))->all();
        }else{
            $result = app(str_replace('+', "\\", str_replace('_', "\\", $tablesearched)))->where($columnshowed, 'LIKE', $req->term)->get();
        }
        $results = array();

        if($req->requi == "false" || $req->requi == false){
            $results[] = [
                'id' => '',
                'text' => __('littleadm/littleadm.lang.none'),
            ];
        }

        foreach($result as $res){
            $results[] = [
                'id' => $res->id,
                'text' => LocaleTrt::isTrans($res[$columnshowed]) ? LocaleTrt::getTradCompressed($res[$columnshowed], app()->getLocale()) : $res[$columnshowed],
            ];
        }


        return response()->json([
            "results" => $results,
            "pagination" => [
                "more" => false
            ],
        ], 200);
    }

    /**
     * Relation Many c(R)ud
     * @param $req Instance of Request
     * @return Response
    */
    public function relationmany(Request $req){
        $modelr = $req->model;
        $name = $req->name;
        $this->action("RELATION_MANY", ['req' => $req, 'model' => $modelr, 'name' => 'name'], auth()->user());
        $model = app(str_replace('+', "\\", str_replace('_', "\\", $modelr)));
        $schema = LADSchemaManager::table($model->getTable())->columns;
        $values = $model->getRel($name);


        return response()->json([
            "values" => $values,
            "schema" => $schema,
        ], 200);
    }
}
