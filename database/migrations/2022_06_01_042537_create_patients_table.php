<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigInteger('NIK')->primary();
            $table->bigInteger('no_BPJS')->index();
            $table->string('nama');
            $table->string('alamat');
            $table->date('tgl_lahir');
            $table->enum('gol_darah',['O-','O+','A-','A+','B-','B+','AB-','AB+']);
            

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
        Schema::dropIfExists('patients');
    }
}
