<?php
namespace OMerz\HeroADM\Modules;

class BaseConfiless {
    /**
     * Configs Saved in configs variable
     */
    protected $configs = array();

    /**
     * Constructing Confiless
     */
    public function __construct($model){
        $this->configs = $model;
    }

    /**
     * Create Config
     * @param array push
     * @return Array
     */
    public function create(array $push){
        $config = $this->configs->create($push);
        return $config;
    }

    /**
     * Get Config | defualt val
     * @param name
     * @param defualt
     * @return Array
     */
    public function get($name, $defualt = "off"){
        $config = $this->configs->where("name", $name)->first();

        if($config){
            return $config->val;
        }

        return $defualt;
    }

    /**
     * Get All Models of Configs
     * @param order
     * @return Array
     */
    public function all(){
        return $this->configs;
    }

    /**
     * Setting Defualt Config
     * @param name
     * @param def
     * @return Confiless
     */
    public function setDefault($name, $def = "off"){
        $configr = $this->configs->where("name", $name)->first();

        if($configr){
            $configr->default_val = $def;
            $configr->save();
        }

        return $this;
    }

    /**
     * Setting Que Config
     * @param name
     * @param def
     * @return Confiless
     */
    public function setQue($name, $que = 0){
        $configr = $this->configs->where("name", $name)->first();

        if($configr){
            $configr->que = $def;
            $configr->save();
        }

        return $this;
    }

    /**
     * Delete Config
     * @param name
     * @param def
     * @return Confiless
     */
    public function delete($name){
        $configr = $this->configs->where("name", $name)->first();

        if($configr){
            $configr->delete();
        }

        return $this;
    }

    /**
     * Get The Model of The Config or null
     * @param name
     * @param default
     * @return Model | null
     */
    public function getModel($name, $defualt = "off"){
        $config = $this->configs->where("name", $name)->first();
        return null;
    }

    /**
     * Setting Config
     * @param order
     * @param value
     * @return Confiless
     */
    public function set($name, $value = "off"){
        $configr = $this->configs->where("name", $name)->first();

        if($configr){
            $configr->val = $value;
            $configr->save();
        }

        return $this;
    }

    /**
     * Has Config
     * @param name
     * @return true | false
     */
    public function has($name){
        $configr = $this->configs->where("name", $name)->first();

        if($configr){
            if($configr->val != "off" && $configr->val != "" && $configr->val != "0" && $configr->val != null){
                return true;
            }
            return false;
        }

        return false;
    }

    /**
     * Get All Configs
     * @param order
     * @return Collection
     */
    public function getAll($order = "switch"){
        if($order == "switch"){
            return $this->configs->orderBy("type", "asc")->orderBy("display_name", "asc")->get();
        }else{
            return $this->configs->orderBy("type", "desc")->orderBy("display_name", "asc")->get();
        }
    }

    /**
     * Save All Configs
     * @param datas
     * @return Confiless
     */
    public function saveAll(array $datas){
        foreach ($this->configs->get() as $conf){
            if(isset($datas[$conf->name])){
                if($datas[$conf->name] == "//"){
                    $conf->val = $conf->default_val;
                }else{
                    $req = $datas[$conf->name];
                    $conf->val = $req;
                }
                $conf->save();
            }else{
                if($conf->type == "switch"){
                    $conf->val = "off";
                    $conf->save();
                }else{
                    $conf->val = $conf->default_val;
                    $conf->save();
                }
            }
        }

        return $this;
    }

    /**
     * Setting All Configs to default
     * @return Confiless
     */
    public function setAllToDefault(){
        foreach($this->configs->get() as $config){
            $config->val = $config->default_val;
            $config->save();
        }

        return $this;
    }
}
