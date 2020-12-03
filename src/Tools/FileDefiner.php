<?php
namespace OMerz\HeroADM\Tools;

use Illuminate\Support\Facades\Storage;

class FileDefiner {
    public $mime;
    public $name;
    public $size;
    public $path;
    public $type;

    public static function byFiles(array $array, $prefixin, $prefixout){
        $data = array();

        foreach($array as $item){
            $data[] = new FileDefiner(str_replace($prefixin, $prefixout, $item), "file");
        }

        return $data;
    }

    public static function byDirectories(array $array, $prefixin, $prefixout){
        $data = array();

        foreach($array as $item){
            $data[] = new FileDefiner(str_replace($prefixin, $prefixout, $item), "dir");
        }

        return $data;
    }

    public function __construct($path, $defineAs = "file"){
        $file = pathinfo(public_path() . $path);

        if($defineAs != "dir") $this->mime = $file['extension'];
        $this->name = $file['filename'];
        $this->size = filesize($file['dirname'] . '/' . $file['basename']);
        $this->path = $path;
        $this->type = $defineAs;
    }

    public function is($mime){
        if(str_replace(".", "", $this->$mime) == str_replace(".", "", $mime)){
            return true;
        }

        return false;
    }

    public function getStorage() {
        return Storage::get($this);
    }
}
