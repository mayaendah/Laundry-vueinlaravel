<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\outlet;

class paket extends Model
{
    use HasFactory;
    protected $table='pakets';
    protected $fillable=[
        'id_outlet','nama_paket','gbr_paket','harga_paket'
    ];

    public function outlet(){
        $this->belongsTo(outlet::class);
    }
}
