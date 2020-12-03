<?php

namespace OMerz\HeroADM\Http\Controllers;


use DateTime;

use App\Models\User;
use Illuminate\Http\Request;
use OMerz\HeroADM\Modules\Permi;
use Illuminate\Support\Facades\DB;
use OMerz\HeroADM\Models\Mbuilder;
use OMerz\HeroADM\Tools\ArrayCompb;
use OMerz\HeroADM\Tools\ObjectComp;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use OMerz\HeroADM\Classes\Installer;
use OMerz\HeroADM\Tools\FileDefiner;
use Illuminate\Support\Facades\Storage;
use OMerz\HeroADM\Notifications\HeroADM;
use OMerz\HeroADM\Tools\Locale\LocaleTrt;
use OMerz\HeroADM\HeroConfig as ConfilessHero;


class HEROAdminController extends Controller
{
    /* Media Editing Support files*/ protected $mesupfiles = array('html', 'bheroe.php', 'php', 'css', 'js');

    protected $configs;
    protected $roleuser = "user";
    protected $roleadmin = "admin";
    protected $menuitems = array();

    public function __construct(){
        $this->configs = new ConfilessHERO;
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
            session()->flash('confirm', ['title' => 'Installing HeroADM', 'route' => 'heroadm.install']);
        }

        if(view()->exists('customhero.index')){
            return view('customhero.index', $datas);
        }
        return view('heroadm.views.index', $datas);
    }

    public function install(){
        if($this->configs->get('role_cont_configs', 'DEFDEF') != "DEFDEF"){
            return redirect()->back()->with(['error' => ['The LittleADM Already Installed']]);
        }
        if(Installer::handle()){
            return redirect()->back()->with(['success' => ['Installed Successfully! Ready To Use']]);
        }
        return redirect()->back()->with(['error' => ['Install Fail!']]);
    }

    // Configs

    public function configs(){
        if(!in_array(auth()->user()->role, explode('|', $this->configs->get('role_cont_configs')))){
            abort(403, 'Unauthorized');
        }

        $datas = $this->compactsview('Configs');

        if(view()->exists('customhero.configs')){
            return view('customhero.configs', $datas);
        }
        return view('heroadm.views.configs.index', $datas);
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

            if(view()->exists('customhero.users.notify')){
                return view('customhero.users.notify', $datas);
            }
            return view('heroadm.views.users.notify', $datas);
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

            return redirect(route('heroadm.users'))->with([
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

        if(view()->exists('customhero.media.index')){
            return view('customhero.media.index', $datas);
        }
        return view("heroadm.views.media.index", $datas);
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

        if(view()->exists('customhero.media.upload')){
            return view('customhero.media.upload', $datas);
        }
        return view('heroadm.views.media.upload', $datas);
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

        if(view()->exists('customhero.media.new')){
            return view('customhero.media.new', $datas);
        }
        return view('heroadm.views.media.new', $datas);
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

        if(view()->exists('customhero.media.edit')){
            return view('customhero.media.edit', $datas);
        }
        return view('heroadm.views.media.edit', $datas);
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
        return redirect(route('heroadm.media', ['path' => '/']))->with([
            'success' => ['File Created: ' . $req->path]
        ]);
    }
}
