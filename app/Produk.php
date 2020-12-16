<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $fillable = ['namaproduk', 'harga','foto'];

    public function getFoto()
    {
        if (!$this->foto) {
            return asset('images/default.jpeg');
        }
        return asset('images/' . $this->foto);
    }

    public function eoq()
    {
        return $this->hasMany('App\Eoq',);
    }

    public function produksi()
    {
        return $this->hasMany('App\Produksi','id_produk','id');
    }
}
