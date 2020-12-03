<?php

namespace OMerz\HeroADM\Models;

use Illuminate\Database\Eloquent\Model;

class Mbuilder extends Model
{
    protected $fillable = ["id", "name", "icon", "type", "val", "permi"];
}
