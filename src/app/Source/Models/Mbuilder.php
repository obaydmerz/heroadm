<?php

namespace App\LittleADM;

use Illuminate\Database\Eloquent\Model;

class Mbuilder extends Model
{
    protected $fillable = ["id", "name", "icon", "type", "val", "permi"];
}
