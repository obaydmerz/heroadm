<?php

namespace App\LittleADM\Tools\Provide;
use App\LittleADM\Tools\ArrayCompb;
use App\LittleADM\Configs\Auth;

class Config extends BaseProvider
{
    protected $configs;

    public function register($name, $val){
        $this->configs[] = $val;
    }

    public function handle(){
        // Add All Configs

        /* Register Auth Configs */ $this->register('auth', \App\LittleADM\Configs\Auth::init());

        // Provide Configs
        $this->providing($this->configs);
    }
}
