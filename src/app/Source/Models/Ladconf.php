<?php

namespace App\LittleADM;

use Illuminate\Database\Eloquent\Model;

class Ladconf extends Model
{
    protected $fillable = ["id", "name", "display_name", "val", "default_val", "que", "desc", "type"];
}
