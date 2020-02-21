<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePembayaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_pembayaran', function (Blueprint $table) {
            $table->increments('id_pembayaran');
            $table->integer('id_petugas');
            $table->string('nisn',10);
            $table->date('tgl_bayar');
            $table->string('bulan_bayar',8);
            $table->string('tahun_bayar',4);
            $table->integer('id_spp');
            $table->integer('nominal');

//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_spp');
    }
}
