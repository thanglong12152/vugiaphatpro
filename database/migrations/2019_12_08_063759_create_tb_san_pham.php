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
            $table->unsignedBigInteger('id_loai_sp_con');
            $table->string('ten_sp')->nullable();
            $table->string('slug')->nullable();
            $table->string('ma_sp')->nullable();
            $table->string('anh_sp')->nullable();
            $table->string('gia_goc')->nullable();  
            $table->string('sale_price')->nullable();
            $table->string('kich_thuoc_sp')->nullable();
            $table->unsignedBigInteger('id_thuong_hieu')->nullable();
            $table->string('chat_lieu')->nullable();
            $table->unsignedBigInteger('id_xuat_xu');
            $table->string('thiet_ke')->nullable();
            $table->string('thoi_gian_bh')->nullable();
            $table->string('chuc_nang')->nullable();
            $table->string('phu_kien_di_kem')->nullable();
            $table->string('max_people')->nullable();
            $table->string('cong_suat_may')->nullable();
            $table->string('chung_loai')->nullable();
            $table->string('dien_nang')->nullable();
            $table->string('ong_cap_nuoc')->nullable();
            $table->string('day_dien')->nullable();
            $table->string('kieu_dang')->nullable();
            $table->string('loai_den')->nullable();
            $table->string('mau_sac')->nullable();
            $table->string('sai_canh')->nullable();
            $table->string('dong_co')->nullable();
            $table->string('cong_suat_den')->nullable();
            $table->foreign('id_loai_san_pham')->references('id_loai_san_pham')->on('tb_loai_san_pham');
            $table->foreign('id_loai_sp_con')->references('id')->on('tb_sub_categories');
            $table->foreign('id_thuong_hieu')->references('id')->on('tb_thuong_hieu');
            $table->foreign('id_xuat_xu')->references('id_xuat_xu')->on('tb_xuat_xu');
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
