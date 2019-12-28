<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTBTinhNang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_tinh_nang', function (Blueprint $table) {
            $table->bigIncrements('id_tinh_nang');
            $table->string('ten_tinh_nang');
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
        Schema::dropIfExists('tb_tinh_nang');
    }
}
