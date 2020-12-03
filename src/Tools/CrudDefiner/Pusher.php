<?php
namespace OMerz\HeroADM\Tools\CrudDefiner;

use OMerz\HeroADM\Tools\Locale\LocaleTrt;
use Illuminate\Support\Facades\Hash;
use OMerz\HeroADM\Tools\Schema\SchemaManager;
use OMerz\HeroADM\HEROConfig;
use OMerz\HeroADM\Tools\ObjectComp;
use OMerz\HeroADM\Tools\ArrayCompb;
use Image;
use Illuminate\Support\Facades\Storage;

class Pusher {
    public static function make($columns, $req, $name){
        $push = array();
        foreach ($columns as $col) {
            if(isset($col->datas['rolescontrol']) ? in_array(auth()->user()->role, explode('|', $col->datas['rolescontrol'])) : true){
                switch ($col->type) {
                    case 'string':
                        if((isset($col->datas['trans']) ? $col->datas['trans'] != false : false) ? true : isset($req[$col->name])){
                            if($trans = (isset($col->datas['trans']) ? $col->datas['trans'] : false)){
                                $lstr = [];
                                foreach ($trans['langs'] as $value) {
                                    $lstr[$value] = $req[$col->name . '_' . $value];
                                }
                                $push[$col->name] = LocaleTrt::compress($lstr);
                            }
                            else $push[$col->name] = $req[$col->name];
                        }else{
                            if($col->default != 'SQLDEFAULT*'){
                                $push[$col->name] = $col->def;
                            }
                        }
                        break;
                    case 'email':
                        if(isset($req[$col->name])){
                            $push[$col->name] = $req[$col->name];
                        }else{
                            if($col->default != 'SQLDEFAULT*'){
                                $push[$col->name] = $col->def;
                            }
                        }
                        break;
                    case 'text':
                        if((isset($col->datas['trans']) ? $col->datas['trans'] != false : false) ? true : isset($req[$col->name])){
                            if($trans = (isset($col->datas['trans']) ? $col->datas['trans'] : false)){
                                $lstr = [];
                                foreach ($trans['langs'] as $value) {
                                    $lstr[$value] = $req[$col->name . '_' . $value];
                                }
                                $push[$col->name] = LocaleTrt::compress($lstr);
                            }
                            else $push[$col->name] = $req[$col->name];
                        }else{
                            if($col->default != 'SQLDEFAULT*'){
                                $push[$col->name] = $col->def;
                            }
                        }
                        break;
                    case 'file':
                        if(isset($req[$col->name])){
                            if($req->hasFile($col->name)){
                                $file = $req->file($col->name);
                                $fn = $file->getClientOriginalName();
                                $ext = $file->getClientOriginalExtension();
                                $filename = $fn . '_' . time() . '.' . $ext;
                                $filestored = $file->storeAs('public/' . $name . '/' . $col->name, $filename);
                                if($col->datas['type'] == "image"){
                                    $vara = ObjectComp::extract($col->datas['resize']);
                                    $thumbnailpath = public_path('storage/' . $name . '/' . $col->name . '/' . $filename);
                                    $img = Image::make($thumbnailpath)->resize((!isset($vara['width']) && $vara['width'] == '*' ? null : $vara['width']), (!isset($vara['height']) && $vara['height'] == '*' ? null : $vara['height']), function($constraint) {
                                        $constraint->aspectRatio();
                                    });
                                    $img->save($thumbnailpath);
                                }
                            }else{
                                $filename = str_replace('%DIR%', 'public/' . $name . '/' . $col->name, $col->def);
                            }

                            $push[$col->name] = $filename;
                        }else{
                            if($col->default != 'SQLDEFAULT*'){
                                $push[$col->name] = $col->def;
                            }
                        }
                        break;
                    case 'imageurl':
                        if(isset($req[$col->name])){
                            if(isset($req[$col->name])){
                                $push[$col->name] = $req[$col->name];
                            }else{
                                $push[$col->name] = $col->def;
                            }
                        }else{
                            if($col->default != 'SQLDEFAULT*'){
                                $push[$col->name] = $col->def;
                            }
                        }
                        break;
                    case 'integer':
                        if(isset($req[$col->name])){
                            $push[$col->name] = intval($req[$col->name]);
                        }else{
                            if($col->default != 'SQLDEFAULT*'){
                                $push[$col->name] = $col->def;
                            }
                        }
                        break;
                    case 'password':
                        $push[$col->name] = isset($col->datas['hashing']) && $col->datas['hashing'] == true ? Hash::make($req[$col->name]) : $req[$col->name];
                        break;
                    case 'default':
                        if(isset($req[$col->name])){
                            $push[$col->name] = $col->def;
                        }else{
                            if($col->default != 'SQLDEFAULT*'){
                                $push[$col->name] = $col->def;
                            }
                        }
                        break;
                    case 'relation':
                        if(isset($req[$col->name])){
                            if(!(isset($col->datas['auto_create']) && $col->datas['auto_create'] == true)){
                                if(isset($req[$col->name])){
                                    $push[$col->name] = $req[$col->name];
                                }else{
                                    $push[$col->def] = $col->def;
                                }
                            }
                        }else{
                            if($col->default != 'SQLDEFAULT*'){
                                $push[$col->name] = $col->def;
                            }
                        }
                        break;
                    case 'enum':
                        if(isset($req[$col->name])){
                            $push[$col->name] = $req[$col->name];
                        }else{
                            if($col->default != 'SQLDEFAULT*'){
                                $push[$col->name] = $col->def;
                            }
                        }
                        break;            
                    case 'switch':
                        if(isset($req[$col->name])){
                            $push[$col->name] = $req[$col->name];
                        }else{
                            $push[$col->name] = "off";
                        }
                        break;            
                    case 'date':
                        if(isset($req[$col->name])){
                            $push[$col->name] = $req[$col->name];
                        }else{
                            if($col->default != 'SQLDEFAULT*'){
                                $push[$col->name] = $col->def;
                            }
                        }
                        break;
                    case 'url':
                        if(isset($req[$col->name])){
                            $push[$col->name] = $req[$col->name];
                        }else{
                            if($col->default != 'SQLDEFAULT*'){
                                $push[$col->name] = $col->def;
                            }
                        }
                        break;
                    case 'auto_increment':
                        break;
                }
            }
        }

        return $push;
    }

    public static function update($columns, $req, $model, $name){
        $push = array();
        foreach ($columns as $col) {
            if(isset($col->datas['rolescontrol']) ? in_array(auth()->user()->role, explode('|', $col->datas['rolescontrol'])) : true){
                switch ($col->type) {
                    case 'string':
                        if((isset($col->datas['trans']) ? $col->datas['trans'] != false : false) ? true : isset($req[$col->name])){
                            if($trans = (isset($col->datas['trans']) ? $col->datas['trans'] : false)){
                                $lstr = [];
                                foreach ($trans['langs'] as $value) {
                                    $lstr[$value] = $req[$col->name . '_' . $value];
                                }
                                $push[$col->name] = LocaleTrt::compress($lstr);
                            }
                            else $push[$col->name] = $req[$col->name];
                        }else{
                            if($col->default != 'SQLDEFAULT*'){
                                $push[$col->name] = $col->def;
                            }
                        }
                        break;
                    case 'email':
                        if(isset($req[$col->name])){
                            $push[$col->name] = $req[$col->name];
                        }else{
                            if($col->default != 'SQLDEFAULT*'){
                                $push[$col->name] = $col->def;
                            }
                        }
                        break;
                    case 'integer':
                        if(isset($req[$col->name])){
                            $push[$col->name] = intval($req[$col->name]);
                        }else{
                            if($col->default != 'SQLDEFAULT*'){
                                $push[$col->name] = $col->def;
                            }
                        }
                        break;
                    case 'password':
                        if(isset($req[$col->name])){
                            if(isset($req[$col->name])){
                                $push[$col->name] = isset($col->datas['hashing']) && $col->datas['hashing'] == true  ? Hash::make($req[$col->name]) : $req[$col->name];
                            }else{
                                $push[$col->name] = $col->default == null ? $model[$col->name] : $col->default;
                            }
                        }else{
                            if($col->default != 'SQLDEFAULT*'){
                                $push[$col->name] = $col->def;
                            }
                        }
                        break;
                    case 'text':
                        if((isset($col->datas['trans']) ? $col->datas['trans'] != false : false) ? true : isset($req[$col->name])){
                            if($trans = (isset($col->datas['trans']) ? $col->datas['trans'] : false)){
                                $lstr = [];
                                foreach ($trans['langs'] as $value) {
                                    $lstr[$value] = $req[$col->name . '_' . $value];
                                }
                                $push[$col->name] = LocaleTrt::compress($lstr);
                            }
                            else $push[$col->name] = $req[$col->name];
                        }else{
                            if($col->default != 'SQLDEFAULT*'){
                                $push[$col->name] = $col->def;
                            }
                        }
                        break;
                    case 'file':
                        if($req->hasFile($col->name)){
                            $file = $req->file($col->name);
                            $fn = $file->getClientOriginalName();
                            $ext = $file->getClientOriginalExtension();
                            $filename = $fn . '_' . time() . '.' . $ext;
                            $filestored = $file->storeAs('public/' . $name . '/' . $col->name, $filename);
                            $push[$col->name] = $filename;
                            if($col->datas['type'] == "image"){
                                $vara = ObjectComp::extract($col->datas['resize']);
                                $thumbnailpath = public_path('storage/' . $name . '/' . $col->name . '/' . $filename);
                                $img = Image::make($thumbnailpath)->resize((!isset($vara['width']) && $vara['width'] == '*' ? null : $vara['width']), (!isset($vara['height']) && $vara['height'] == '*' ? null : $vara['height']), function($constraint) {
                                    $constraint->aspectRatio();
                                });
                                $img->save($thumbnailpath);
                            }
                        }

                        if($model[$col->name] != $req[$col->name] && isset($req[$col->name])){
                            Storage::delete('public/' . $name . '/' . $col->name . '/' . $model[$col->name]);
                        }


                        break;
                    case 'imageurl':
                        if(isset($req[$col->name])){
                            if(isset($req[$col->name])){
                                $push[$col->name] = $req[$col->name];
                            }
                        }else{
                            if($col->default != 'SQLDEFAULT*'){
                                $push[$col->name] = $col->def;
                            }
                        }
                        break;
                    case 'enum':
                        if(isset($req[$col->name])){
                            $push[$col->name] = $req[$col->name];
                        }else{
                            $push[$col->name] = "off";
                        }
                        break;
                    case 'switch':
                        if(isset($req[$col->name])){
                            $push[$col->name] = $req[$col->name];
                        }else{
                            if($col->default != 'SQLDEFAULT*'){
                                $push[$col->name] = $col->def;
                            }
                        }
                        break;
                    case 'url':
                        if(isset($req[$col->name])){
                            if(isset($req[$col->name])){
                                $push[$col->name] = $req[$col->name];
                            }
                        }else{
                            if($col->default != 'SQLDEFAULT*'){
                                $push[$col->name] = $col->def;
                            }
                        }
                        break;
                    case 'relation':
                        if(isset($req[$col->name])){
                            if(!(isset($col->datas['auto_create']) && $col->datas['auto_create'] == true)){
                                if(isset($req[$col->name])){
                                    $push[$col->name] = $req[$col->name];
                                }else{
                                    $push[$col->name] = $col->def;
                                }
                            }
                        }else{
                            if($col->default != 'SQLDEFAULT*'){
                                $push[$col->name] = $col->def;
                            }
                        }
                        break;
                    case 'default':
                        if(isset($req[$col->name])){
                            $push[$col->name] = $col->def;
                        }else{
                            if($col->default != 'SQLDEFAULT*'){
                                $push[$col->name] = $col->def;
                            }
                        }
                        break;
                    case 'date':
                        if(isset($req[$col->name])){
                            $push[$col->name] = $req[$col->name];
                        }else{
                            if($col->default != 'SQLDEFAULT*'){
                                $push[$col->name] = $col->def;
                            }
                        }
                        break;
                    case 'auto_increment':
                        break;
                }
            }
        }

        return $push;
    }
}
