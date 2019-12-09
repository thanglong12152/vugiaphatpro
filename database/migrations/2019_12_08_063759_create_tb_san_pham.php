<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbSanPham extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_san_pham', function (Blueprint $table) {
            $table->bigIncrements('id_san_pham');
            $table->unsignedBigInteger('id_loai_san_pham');
            $table->string('ten_sp')->nullable();
            $table->string('ma_sp')->nullable();
            $table->string('kich_thuoc_sp')->nullable();
            $table->string('thuong_hieu')->nullable();
            $table->string('chat_lieu')->nullable();
            $table->string('xuat_xu')->nullable();
            $table->string('thiet_ke')->nullable();
            $table->string('thoi_gian_bh')->nullable();
            $table->string('chuc_nang')->nullable();
            $table->string('phu_kien_di_kem')->nullable();
            $table->foreign('id_loai_san_pham')->references('id_loai_san_pham')->on('tb_loai_san_pham');
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
        Schema::dropIfExists('tb_san_pham');
    }
}
