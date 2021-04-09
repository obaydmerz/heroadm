<?php

namespace OMerz\HeroADM\Models;

use Illuminate\Database\Eloquent\Model;

class Heromrole extends Model
{
    protected $fillable = ["id", "type", "value", "heromodel_id", "create", "read", "update", "delete"];
}
