<?php

namespace OMerz\HeroADM\Models;

use Illuminate\Database\Eloquent\Model;

class Heromcolumn extends Model
{
    protected $fillable = ["id", "name", "type", "datas", "display_name", "validator", "required", "unique", "def", "primary", "heromodel_id"];

    public function model(){
        return app($this->path);
    }

    public function columns(){
        return $this->hasMany("OMerz\HeroADM\Models\Heromcolumn");
    }

    public function getProprety($prop) {
        $reflection = new ReflectionClass($this->model);
        $property = $reflection->getProperty($prop);
        $property->setAccessible(true);
        return $property->getValue($obj);
    }
}
