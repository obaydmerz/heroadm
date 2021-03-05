<?php
namespace OMerz\HeroADM\Modules;
use OMerz\HeroADM\Models\Heroconf;
use OMerz\HeroADM\Modules\BaseConfiless;

class HERODataConfig extends BaseConfiless {
    public function __construct(){
        $this->configs = new Heroconf;
    }
}
