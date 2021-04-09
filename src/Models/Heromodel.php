<?php

namespace OMerz\HeroADM\Models;

use Illuminate\Database\Eloquent\Model;

class Heromodel extends Model
{
    protected $fillable = ["id", "name", "path"];

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
        return $property->getValue($this->model);
    }
}
