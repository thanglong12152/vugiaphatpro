<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKichthuocSanpham extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kichthuoc_sanpham', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_san_pham');
            $table->unsignedBigInteger('id_kich_thuoc');
            $table->foreign('id_san_pham')->references('id_san_pham')->on('tb_san_pham');
            $table->foreign('id_kich_thuoc')->references('id_kich_thuoc')->on('tb_kich_thuoc');
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
        Schema::dropIfExists('tb_kichthuoc_sanpham');
    }
}
