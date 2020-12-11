<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JadwalProduksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_produksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('produk',50);
            $table->Integer('jumlahBahan');
            $table->date('tanggal');
            $table->String('status',10);
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
        Schema::dropIfExists('jadwal_produksi');
    }
}
