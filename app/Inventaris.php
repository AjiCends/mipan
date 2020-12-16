<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
  protected $table = 'inventaris';
  protected $fillable = ['id_karyawan', 'nama_alat','jumlah','foto'];

  public function getFoto()
  {
      if (!$this->foto) {
          return asset('images/default.jpeg');
      }
      return asset('images/' . $this->foto);
  }
}
