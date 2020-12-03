<?php
namespace OMerz\HeroADM\Tools\CrudDefiner;

class Column {
    public $name;
    public $display_name;
    public $type;
    public $unique;
    public $validator;
    public $required;
    public $datas;
    public $def;
    public $prim;
    public $default;

    public function __construct($name, $display_name, $type, $required = false, $datas = array(), $default = "", $validator = "", $unique = false){
        $this->name = $name;
        $this->type = $type;
        $this->datas = $datas;
        $this->display_name = $display_name;
        $this->validator = $validator;
        $this->required = $required;
        $this->unique = $unique;
        $this->def = $default;
        $this->prim = false;
        $this->default = $default;
    }
}
