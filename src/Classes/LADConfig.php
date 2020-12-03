<?php
namespace OMerz\HeroADM\Models;
use App\LittleADM\Ladconf;
use OMerz\HeroADM\Modules\BaseConfiless;

class LADConfig extends BaseConfiless {
    public function __construct(){
        $this->configs = new Ladconf;
    }
}
