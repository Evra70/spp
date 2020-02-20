<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_siswa', function (Blueprint $table) {
            $table->increments('id_siswa');
            $table->string('nisn',10);
            $table->string('nis',8);
            $table->string('nama',35);
            $table->integer('id_kelas');
            $table->text('alamat');
            $table->string('no_telp',13);
            $table->integer('id_spp');
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
        Schema::dropIfExists('t_siswa');
    }
}
