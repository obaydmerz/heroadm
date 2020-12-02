<?php
namespace App\LittleADM;
use App\LittleADM\Ladconf;

class LADConfig extends BaseConfiless {
    public function __construct(){
        $this->configs = new Ladconf;
    }
}
