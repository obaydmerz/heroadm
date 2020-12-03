<?php
namespace OMerz\HeroADM\Tools;

class Crud {
    protected $columns = array();

    public function register(array $columns){
        foreach ($columns as $col) {
            $this->columns[] = $col;
        }
    }

    public function get(){
        return $this->columns;
    }
}
