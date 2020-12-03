<?php
namespace OMerz\HeroADM\Tools\Contracts;

use OMerz\HeroADM\Tools\Locale\LocaleTrt;
use Illuminate\Support\Facades\Hash;
use OMerz\HeroADM\Tools\Schema\SchemaManager;
use OMerz\HeroADM\HEROConfig;
use OMerz\HeroADM\Tools\ObjectComp;
use OMerz\HeroADM\Tools\ArrayCompb;
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
