<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Petugas extends Authenticatable
{
    protected $table = "t_petugas";
    protected $primaryKey = "id_petugas";
    public $timestamps = false;
}
