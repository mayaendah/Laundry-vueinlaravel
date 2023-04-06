<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keranjang extends Model
{
    use HasFactory;
    protected $table='keranjangs';
    protected $fillable=[
       'id_transaksi','paket','berat_paket','ket_paket'
    ];
}
