<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal_produksi extends Model
{
    protected $table = 'jadwal_produksi';
    protected $fillable = ['produk', 'jumlahBahan'=>0,'tanggal','status','karyawan_id'=>0];
}
