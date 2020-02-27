<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Spp extends Model
{
    protected $table = "t_spp";
    protected $primaryKey = "id_spp";
    public $timestamps = false;
}
