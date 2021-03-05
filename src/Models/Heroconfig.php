<?php

namespace OMerz\HeroADM\Models;

use Illuminate\Database\Eloquent\Model;

class Heroconfig extends Model
{
    protected $fillable = ["id", "name", "display_name", "val", "default_val", "que", "desc", "type"];
}
