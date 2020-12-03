<?php

namespace App\LittleADM\Http\Controllers;


use DateTime;

use App\LittleADM\LADConfig as ConfilessLAD;
use App\Models\User;
use App\LittleADM\Mbuilder;
use App\Notifications\LittleADM\LittleADM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\LittleADM\Tools\Locale\LocaleTrt;
use App\LittleADM\Permi;
use App\LittleADM\Tools\ObjectComp;
use App\LittleADM\Tools\FileDefiner;
use App\LittleADM\Tools\ArrayCompb;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class LADAdminController extends Controller
{
    /* Media Editing Support files*/ protected $mesupfiles = array('html', 'blade.php', 'php', 'css', 'js');

    protected $configs;
    protected $roleuser = "user";
    protected $roleadmin = "admin";
    protected $menuitems = array();

    public function __construct(){
        $this->configs = new ConfilessLAD;
        $this->menuitems = Mbuilder::all();
    }

    // Index

    /**
     * Compact Datas
     * @param array $array Instance Of Array
     * @return array
    */
    protected function compacts(array $array){
        return ArrayCompb::join($array, [
            'localetrt' => new LocaleTrt,
            'configs' => $this->configs,
            "permi" => new Permi('cover', []),
            "menuitems" => Mbuilder::all(),
        ]);
    }

    /**
     * Simple Compact Datas
     * @param $collection
     * @param $additionaltitle
     * @return array
    */
    protected function compactsview($title = null, $additionalvars = null){
        if($additionalvars == null){
            return $this->compacts([
                "title" => ($title != null ? $title : ''),
            ]);
        } else {
            return ArrayCompb::join($this->compacts([
                "title" => ($title != null && $title != "" ? $title : ''),
            ]), $additionalvars);
        }
    }

    public function index(){
        $datas = $this->compactsview('Dashboard', [
            'users' => User::all(),
            'ucount' => User::all()->count(),
        ]);

        if($this->configs->get('role_cont_configs', 'DEFDEF') == "DEFDEF"){
            session()->flash('confirm', ['title' => 'Installing LittleADM', 'route' => 'littleadm.install']);
        }

        if(view()->exists('customlad.index')){
            return view('customlad.index', $datas);
        }
        return view('littleadm.views.index', $datas);
    }

    public function install(){
        if($this->configs->get('role_cont_configs', 'DEFDEF') != "DEFDEF"){
            return redirect()->back()->with(['error' => ['The LittleADM Already Installed']]);
        }
        $this->configs->create([
            'name' => 'role_cont_configs',
            'type' => 'input',
            'display_name' => 'Role Controling Configs',
            'desc' => 'Role Controling Configs',
            'val' => 'admin',
            'default_val' => 'admin',
            'que' => 0,
        ]);
        $this->configs->create([
            'name' => 'role_cont_users',
            'type' => 'input',
            'display_name' => 'Role Controling Users',
            'desc' => 'Role Controling Users',
            'val' => 'admin',
            'default_val' => 'admin',
            'que' => 0,
        ]);
        $this->configs->create([
            'name' => 'role_cont_medias',
            'type' => 'input',
            'display_name' => 'Role Controlling Medias',
            'desc' => 'Role Controlling Medias',
            'val' => 'admin',
            'default_val' => 'admin',
            'que' => 0,
        ]);
        $this->configs->create([
            'name' => 'role_cont_mbulider',
            'type' => 'input',
            'display_name' => 'Role Controlling Menu Bulider',
            'desc' => 'Role Controlling Menu Bulider',
            'val' => 'admin',
            'default_val' => 'admin',
            'que' => 0,
        ]);
        $this->configs->create([
            'name' => 'roles_see_littleadm',
            'type' => 'input',
            'display_name' => 'Roles See Dashboard',
            'desc' => 'Roles See Dashboard',
            'val' => 'admin',
            'default_val' => 'admin',
            'que' => 0,
        ]);
        return redirect()->back()->with(['success' => ['Installed Successfully! Ready To Use']]);
    }

    // Configs

    public function configs(){
        if(!in_array(auth()->user()->role, explode('|', $this->configs->get('role_cont_configs')))){
            abort(403, 'Unauthorized');
        }

        $datas = $this->compactsview('Configs');

        if(view()->exists('customlad.configs')){
            return view('customlad.configs', $datas);
        }
        return view('littleadm.views.configs.index', $datas);
    }

    public function saveConfigs(Request $req){
        if(!in_array(auth()->user()->role, explode('|', $this->configs->get('role_cont_configs')))){
            abort(403, 'Unauthorized');
        }

        $this->configs->saveAll($req->all());

        return redirect()->back()->with(["success" => ["Your Settings Saved Successfully!"]]);
    }

    public function defaultConfigs(){
        if(!in_array(auth()->user()->role, explode('|', $this->configs->get('role_cont_configs')))){
            abort(403, 'Unauthorized');
        }

        $this->configs->setAllToDefault();
        return redirect()->back()->with([
            "success" => ["Configs Seted To Default"],
        ]);
    }

    // Sending Notifications

    public function sendntfv($id){
        if(!in_array(auth()->user()->role, explode('|', $this->configs->get('role_cont_users')))){
            abort(403, 'Unauthorized');
        }

        if($user = User::find($id)){
            $datas = $this->compactsview('Users | Notify', ['user' => $user]);

            if(view()->exists('customlad.users.notify')){
                return view('customlad.users.notify', $datas);
            }
            return view('littleadm.views.users.notify', $datas);
        }

        return redirect()->back();
    }

    public function sendntf(Request $req, $id){
        if(!in_array(auth()->user()->role, explode('|', $this->configs->get('role_cont_users')))){
            abort(403, 'Unauthorized');
        }

        $req->validate([
            'data' => 'required|string|max:5000'
        ]);
        if($user = User::find($id)){
            $user->notifyNow(new LittleADM($req->data));

            return redirect(route('littleadm.users'))->with([
                "success" => ["Notification Sended to " . $user->name],
            ]);
        }

        return redirect()->back()->with([
            "error" => ["Sending Notification to " . $user->name . " failed!"],
        ]);
    }


    // Medias

    public function medias(Request $req){
        if(!in_array(auth()->user()->role, explode('|', $this->configs->get('role_cont_medias')))){
            abort(403, 'Unauthorized');
        }

        $path = $req->path;

        $file = pathinfo(public_path() . $path);
        if(isset($file['extension'])){
            return $this->editmediasv($path);
        }

        $datas = $this->compactsview('Media', [
            "files" => FileDefiner::byFiles(Storage::allFiles("/public" . $path), "public/", '/storage/'),
            "dirs" => FileDefiner::byDirectories(Storage::allDirectories("/public" . $path), "public/", '/storage/'),
            'path' => $path,
            'supfiles' => $this->mesupfiles,
        ]);

        if(view()->exists('customlad.media.index')){
            return view('customlad.media.index', $datas);
        }
        return view("littleadm.views.media.index", $datas);
    }

    public function deletemedias(Request $req){
        if(!in_array(auth()->user()->role, explode('|', $this->configs->get('role_cont_medias')))){
            abort(403, 'Unauthorized');
        }

        $req->validate([
            'path' => 'required|string'
        ]);

        if(Storage::delete('public/', $req->path)){
            return redirect()->back()->with([
                'success' => ['Successfull Deleteing Media: ' . $req->path]
            ]);
        }

        return redirect()->back()->with([
            'error' => ['Error Deleting Media: ' . $req->path]
        ]);
    }

    public function storemediasv(){
        if(!in_array(auth()->user()->role, explode('|', $this->configs->get('role_cont_medias')))){
            abort(403, 'Unauthorized');
        }

        $datas = $this->compactsview('Upload Media');

        if(view()->exists('customlad.media.upload')){
            return view('customlad.media.upload', $datas);
        }
        return view('littleadm.views.media.upload', $datas);
    }

    public function storemedias(Request $req){
        if(!in_array(auth()->user()->role, explode('|', $this->configs->get('role_cont_medias')))){
            abort(403, 'Unauthorized');
        }

        $req->validate([
            'path' => 'required|string',
            'file' => 'required',
            'fn' => 'required|string',
        ]);

        $file = $req->file('file');

        $file->storeAs('public/' . $req->path, $req->fn);

        return redirect()->back()->with([
            'success' => ['File Uploaded Media: ' . $req->path]
        ]);
    }

    public function newmediasv(){
        if(!in_array(auth()->user()->role, explode('|', $this->configs->get('role_cont_medias')))){
            abort(403, 'Unauthorized');
        }

        $datas = $this->compactsview('New Media', [
            'supfiles' => $this->mesupfiles,
        ]);

        if(view()->exists('customlad.media.new')){
            return view('customlad.media.new', $datas);
        }
        return view('littleadm.views.media.new', $datas);
    }

    public function editmediasv($path){
        if(!in_array(auth()->user()->role, explode('|', $this->configs->get('role_cont_medias')))){
            abort(403, 'Unauthorized');
        }

        $datas = $this->compactsview('Edit Media', [
            'supfiles' => $this->mesupfiles,
            'path' => $path,
            'data' => Storage::get('public' . $path),
        ]);

        if(view()->exists('customlad.media.edit')){
            return view('customlad.media.edit', $datas);
        }
        return view('littleadm.views.media.edit', $datas);
    }

    public function editmedias(Request $req){
        if(!in_array(auth()->user()->role, explode('|', $this->configs->get('role_cont_medias')))){
            abort(403, 'Unauthorized');
        }

        $req->validate([
            'path' => 'required|string',
            'file' => 'required|string',
        ]);

        

        Storage::put('public/' . $req->path, $req->file);

        if(!isset($req->new)){
            return redirect()->back()->with([
                'success' => ['File Edited: ' . $req->path]
            ]);
        }
        return redirect(route('littleadm.media', ['path' => '/']))->with([
            'success' => ['File Created: ' . $req->path]
        ]);
    }
}
