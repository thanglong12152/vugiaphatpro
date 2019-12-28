<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbViTri extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_vi_tri', function (Blueprint $table) {
            $table->bigIncrements('id_vi_tri');
            $table->string('vi_tri')->nullable();
            $table->unsignedBigInteger('id_san_pham');
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
        Schema::dropIfExists('tb_vi_tri');
    }
}
