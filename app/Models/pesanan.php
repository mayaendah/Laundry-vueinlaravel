<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pesanan extends Model
{
    use HasFactory;
    protected $table='pesanans';
    protected $fillable=[
        'id_header','nama_member','total_biaya'
    ];
}
