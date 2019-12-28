<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbThuongHieuDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_thuong_hieu_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreign('id_thuong_hieu')->references('id')->on('tb_thuong_hieu');
            $table->foreign('id_san_pham')->references('id_san_pham')->on('tb_san_pham');
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
        Schema::dropIfExists('tb_thuong_hieu_detail');
    }
}
