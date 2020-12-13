<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Eoq extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eoq', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('produk',50);
            $table->integer('demand');
            $table->date('tanggal');
            $table->integer('oc');
            $table->integer('cc');
            $table->integer('eoq');
            $table->integer('frekwensi');
            $table->string('interval',10);
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
        Schema::dropIfExists('eoq');
    }
}
