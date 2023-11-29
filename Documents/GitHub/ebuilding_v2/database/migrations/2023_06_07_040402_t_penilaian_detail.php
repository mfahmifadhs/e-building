<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TPenilaianDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_penilaian_detail', function (Blueprint $table) {
            $table->id('id_detail');
            $table->bigInteger('penilaian_id');
            $table->bigInteger('kriteria_id');
            $table->text('keterangan');
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('t_penilaian_detail');
    }
}
