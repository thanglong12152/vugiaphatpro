<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTinhnangLoaisp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_tinhnang_loaisp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_tinh_nang');
            $table->unsignedBigInteger('id_loai_sp');
            $table->foreign('id_tinh_nang')->references('id_tinh_nang')->on('tb_tinh_nang');
            $table->foreign('id_loai_sp')->references('id_loai_san_pham')->on('tb_loai_san_pham');
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
        Schema::dropIfExists('tb_tinhnang_loaisp');
    }
}
