<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePetugas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_petugas', function (Blueprint $table) {
            $table->increments('id_petugas');
            $table->string('username',25);
            $table->string('password',32);
            $table->string('nama_petugas',35);
            $table->enum('level',['admin','petugas']);
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
        Schema::dropIfExists('t_petugas');
    }
}
