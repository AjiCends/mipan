<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal_produksi extends Model
{
    protected $table = 'jadwal_produksi';
    protected $fillable = ['produk_id', 'jumlahBahan'=>0,'tanggal','status','karyawan_id'=>0];

    public function produk()
    {
        return $this->belongsTo('App\Produk','produk_id');
    }
}
