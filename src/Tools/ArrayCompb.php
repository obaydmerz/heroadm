<?php
namespace OMerz\HeroADM\Tools;

class ArrayCompb {
    protected $array;

    public static function join(array $oldarray, array $newarray){
        $result = $oldarray;
        foreach ($newarray as $key => $data) {
            $result[$key] = $data;
        }
        return $result;
    }

    public static function make(array $array = array()){
        return new ArrayCompb($array);
    }

    public function __construct(array $array = array()){
        $this->array = $array;
    }

    public function toObjectC(){
        return ObjectComp::compress($this->array);
    }

    public function add(array $array){
        $result = $this->array;
        foreach ($newarray as $key => $data) {
            $result[$key] = $data;
        }
        $this->array = $result;
        return $this;
    }

    public function toArray(){
        return $this->array;
    }
}
