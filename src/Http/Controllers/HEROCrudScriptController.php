<?php

namespace OMerz\HeroADM\Http\Controllers;


use App\User;

use DateTime;
use Illuminate\Http\Request;
use OMerz\HeroADM\Tools\Crud;
use OMerz\HeroADM\Modules\Permi;
use Illuminate\Support\Facades\DB;
use OMerz\HeroADM\Tools\ArrayCompb;
use OMerz\HeroADM\Tools\ObjectComp;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use OMerz\HeroADM\Modules\HEROConfig;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use OMerz\HeroADM\Tools\Locale\LocaleTrt;
use Illuminate\Contracts\Auth\Access\Gate;
use OMerz\HeroADM\Tools\CrudDefiner\Pusher;
use OMerz\HeroADM\Tools\CrudDefiner\Validator;

use OMerz\HeroADM\Classes\Wheres\WhereMbuilder;
use OMerz\HeroADM\Tools\Schema\HEROSchemaManager;
use Intervention\Image\ImageManagerStatic as Image;


class HEROCrudScriptController extends Controller
{
    protected $rolesallowed = [];
    protected $name = "user";
    protected $configs;
    protected $class = User::class;
    protected $columns = array();
    protected $gate;

    protected function allows_($action, $role){
        Permi::abort($action, $this->rolesallowed, $role);
    }

    /**
     * Construct The Base Controller
     * @return void
    */
    public function _construct($user){
        $this->construct($user);
        $this->constructcolumns();
        $this->configs = new HEROConfig;
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
            "menuitems" => WhereMbuilder::where(),
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
     * Processing Data c(R)ud
     * @return Builder
    */
    public function process($user){
        return $this->class->all();
    }

    /**
     * Index c(R)ud
     * @return View
    */
    public function index_($user){
        $this->allows($this->name . '_read');
        $this->action("READ", [], $user);

        return $this->compactsview($this->process(auth()->user()));
    }

    /**
     * Create (C)rud
     * @return View
    */
    public function create_(){
        $this->allows($this->name . '_create');
        $this->action("CREATE", [], auth()->user());
        return $this->compactsview(null, 'Create');
    }

    /**
     * Store (C)rud
     * @param $req Instance of Request
     * @return Response
    */
    public function store_(Request $req){
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

        return true;
    }

    /**
     * Edit cr(U)d
     * @param $id
     * @return View
    */
    public function edit_($id){
        $this->allows($this->name . '_update');
        if($collection = $this->class->find($id)){
            $this->action("EDIT", ['id' => $id, 'model' => $collection], auth()->user());
            return $this->compactsview($collection);
        }

        return false;
    }

    /**
     * Update cr(U)d
     * @param $req Instance of Request
     * @param $id
     * @return View
    */
    public function update_(Request $req, $id){
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
    
            return true;
        }

        return false;
    }

    /**
     * Delete cru(D)
     * @param $id
     * @return Response
    */
    public function destroy_($id){
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

        return true;
    }

    /**
     * Truncate cr(U)d
     * @return View
    */
    public function truncate_(){
        $this->allows($this->name . '_delete');
        $this->action("TRUNCATE", [], auth()->user());
        $this->class->truncate();
        return true;
    }

    /**
     * Relation c(R)ud
     * @param $req Instance of Request
     * @return Response
    */
    public function relation_(Request $req){
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
                'text' => __('heroadm/heroadm.lang.none'),
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
    public function relationmany_(Request $req){
        $modelr = $req->model;
        $name = $req->name;
        $this->action("RELATION_MANY", ['req' => $req, 'model' => $modelr, 'name' => 'name'], auth()->user());
        $model = app(str_replace('+', "\\", str_replace('_', "\\", $modelr)));
        $schema = HEROSchemaManager::table($model->getTable())->columns;
        $values = $model->getRel($name);


        return response()->json([
            "values" => $values,
            "schema" => $schema,
        ], 200);
    }
}
