<?php

namespace OMerz\HeroADM\Models;

use Illuminate\Database\Eloquent\Model;

class Herotoken extends Model
{
    protected $fillable = ["id", "user_id", "key", "expire_at"];
}
