<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
  protected $table = 'produksi';
  protected $fillable = ['id_Produk', 'id_Karyawan','kuantitas', 'tgl'];


  public function produk()
  {
      return $this->belongsTo('App\Produksi','id_Produk');
  }
  public function karyawan()
  {
      return $this->belongsTo('App\Karyawan','id_Karyawan');
  }
}
