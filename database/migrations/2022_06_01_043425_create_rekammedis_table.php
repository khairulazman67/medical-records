<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekammedisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekammedis', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('no_BPJS');
            
            $table->enum('poliklinik',['Poli Umum','Poli Gigi','Poli KIA','Poli MTBS','Poli Mata']);
            $table->string('keluhan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekammedis');
    }
}
