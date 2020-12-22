<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eoq extends Model
{
  protected $table = 'eoq';
  protected $fillable = ['produk', 'demand', 'tanggal', 'oc', 'cc', 'eoq', 'frekwensi','interval'];

  public function produks()
  {
      return $this->belongsTo('App\Produk','produk');
  }
}
