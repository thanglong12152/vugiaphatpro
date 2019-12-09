<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKhachHang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_khach_hang', function (Blueprint $table) {
            $table->bigIncrements('id_khach_hang');
            $table->string('ten_khach_hang')->nullable();
            $table->string('dia_chi')->nullable();
            $table->string('so_dt')->nullable();
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
        Schema::dropIfExists('tb_khach_hang');
    }
}
