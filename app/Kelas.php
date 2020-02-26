<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Kelas extends Model
{
    protected $table = "t_kelas";
    protected $primaryKey = "id_kelas";
    public $timestamps = false;
}
