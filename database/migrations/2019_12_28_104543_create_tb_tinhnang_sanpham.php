<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTinhnangSanpham extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_tinhnang_sanpham', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_san_pham');
            $table->unsignedBigInteger('id_tinh_nang');
            $table->foreign('id_san_pham')->references('id_san_pham')->on('tb_san_pham');
            $table->foreign('id_tinh_nang')->references('id_tinh_nang')->on('tb_tinh_nang');
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
        Schema::dropIfExists('tb_tinhnang_sanpham');
    }
}
