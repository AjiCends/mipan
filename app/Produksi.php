<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
  protected $table = 'produksi';
  protected $fillable = ['id_Produk', 'id_Karyawan','kuantitas', 'tgl'];
}
