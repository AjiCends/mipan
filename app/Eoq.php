<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eoq extends Model
{
  protected $table = 'eoq';
  protected $fillable = ['demand', 'tanggal', 'oc', 'cc', 'eoq', 'frekwensi'];
}
