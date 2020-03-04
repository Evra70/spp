<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pembayaran extends Model
{
    protected $table = "t_pembayaran";
    protected $primaryKey = "id_pembayaran";
    public $timestamps = false;
}
