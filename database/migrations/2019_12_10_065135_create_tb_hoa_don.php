<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbHoaDon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_hoa_don', function (Blueprint $table) {
            $table->bigIncrements('id_hoa_don');
            $table->unsignedBigInteger('id_khach_hang');
            $table->unsignedBigInteger('id_san_pham');
            $table->integer('so_luong')->nullable();
            $table->string('hinh_thuc_nhan_hang')->nullable();
            $table->foreign('id_khach_hang')->references('id_khach_hang')->on('tb_khach_hang');
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
        Schema::dropIfExists('tb_hoa_don');
    }
}
