<?php

namespace OMerz\HeroADM\Classes\Wheres;

class WhereMbuilder {
    public static function where(){
        return config("heroadm.configs");
    }
}
