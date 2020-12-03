<?php
namespace OMerz\HeroADM\Classes\Wheres;
use OMerz\HeroADM\Models\heroconf;
use OMerz\HeroADM\Modules\BaseConfiless;

class WhereMbuilder {
    public static function where(){
        return config("heroadm.mbuliders");
    }
    public static function wherecrud(){
        $mbs = config("heroadm.mbuliders");
        $nmbs = array();
        foreach($mbs as $mb){
            if($mb["type"] == "crud"){
                $nmbs[] = $mb;
            }
        }
        return $nmbs;
    }
}
