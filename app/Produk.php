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
            return asset('foto/default.jpg');
        }
        return asset('foto/' . $this->foto);
    }
}
