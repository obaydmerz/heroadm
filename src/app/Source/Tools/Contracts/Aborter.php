<?php
namespace App\LittleADM\Tools\Contracts;

use App\LittleADM\Tools\Locale\LocaleTrt;
use Illuminate\Support\Facades\Hash;
use App\LittleADM\Tools\Schema\SchemaManager;
use App\LittleADM\LADConfig;
use App\LittleADM\Tools\ObjectComp;
use App\LittleADM\Tools\ArrayCompb;
use Image;
use Illuminate\Support\Facades\Storage;

class Aborter {
    public static function make($func, $code, $message){
        $result = $func();
        if(!$result){
            abort($code, $message);
        }
    }
}
