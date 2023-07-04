<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_pegawai', function (Blueprint $table) {
            $table->bigIncrements('id_pegawai');
            $table->string('instansi');
            $table->integer('penyedia_id')->nullable();
            $table->integer('unit_kerja_id')->nullable();
            $table->bigInteger('nip');
            $table->string('nama_pegawai');
            $table->string('jenis_kelamin');
            $table->bigInteger('no_hp');
            $table->string('agama');
            $table->text('alamat');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_pegawai');
    }
}
