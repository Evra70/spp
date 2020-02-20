<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa extends Authenticatable
{
    protected $table = "t_siswa";
    protected $primaryKey = "id_siswa";
    public $timestamps = false;
}
