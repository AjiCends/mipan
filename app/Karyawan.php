<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawan';
    protected $fillable = ['nama','gender','alamat','user_id'];

    public function produksi()
    {
        return $this->hasMany('App\Produksi','id_Karyawan','id');
    }

    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
