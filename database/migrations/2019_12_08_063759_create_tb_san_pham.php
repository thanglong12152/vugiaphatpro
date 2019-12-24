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
            $table->string('anh_sp')->nullable();
            $table->string('gia_goc')->nullable();  
            $table->string('sale_price')->nullable();
            $table->string('kich_thuoc_sp')->nullable();
            $table->unsignedBigInteger('id_thuong_hieu')->nullable();
            $table->string('chat_lieu')->nullable();
            $table->string('xuat_xu')->nullable();
            $table->string('thiet_ke')->nullable();
            $table->string('thoi_gian_bh')->nullable();
            $table->string('chuc_nang')->nullable();
            $table->string('phu_kien_di_kem')->nullable();
            $table->string('max_people');
            $table->string('cong_suat_may');
            $table->string('chung_loai');
            $table->string('dien_nang');
            $table->string('ong_cap_nuoc');
            $table->string('day_dien');
            $table->string('kieu_dang');
            $table->string('loai_den');
            $table->string('mau_sac');
            $table->string('sai_canh');
            $table->string('dong_co');
            $table->string('cong_suat_den');
            $table->foreign('id_loai_san_pham')->references('id_loai_san_pham')->on('tb_loai_san_pham');
            $table->foreign('id_thuong_hieu')->references('id')->on('tb_thuong_hieu');
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
