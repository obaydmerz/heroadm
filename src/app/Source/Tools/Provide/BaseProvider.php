<?php

namespace App\LittleADM\Tools\Provide;

class BaseProvider
{
    protected $provided;

    public function handle(){
        //
    }

    public function provide(){
        return $this->provided;
    }

    public function providing($provided){
        $this->provided = $provided;
    }

    public function __construct(){
        $this->handle();
    }
}
