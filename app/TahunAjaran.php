<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TahunAjaran extends Authenticatable
{
    protected $table = "t_tahun_ajaran";
    protected $primaryKey = "id_tahun_ajaran";
    public $timestamps = false;
}
