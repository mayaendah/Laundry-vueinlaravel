<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_pesanan extends Model
{
    use HasFactory;
    protected $table='detail_pesanans';
    protected $fillable=[
        'id_detail_header','id_paket','berat_paket','harga_paket'
    ];
}
