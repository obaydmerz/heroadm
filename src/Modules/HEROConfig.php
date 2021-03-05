<?php
namespace OMerz\HeroADM\Modules;
use OMerz\HeroADM\Modules\HERODataConfig;
use OMerz\HeroADM\Wheres\WhereConfigs;

class HEROConfig {
    public $dataconfig;
    public $confs;

    public function __construct(){
        $dataconfig = new HERODataConfig;
        $confs = WhereConfigs::where();
    }

    public function get($name, $def = null){
        $resp = $def;
        if(isset($this->confs[$name])){
            $resp = $this->confs[$name];
        }else{
            $que = $this->dataconfigs->get($name, null);
            if($que != null){
                $resp = $que;
            }

            if($resp == "on"){
                $resp = true;
            }else if($resp == "off"){
                $resp = false;
            }

        }
        return $resp;
    }
}
