<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\paket;

class outlet extends Model
{
    use HasFactory;
    protected $table='outlets';

    protected $fillable=[
        'nama_outlet','alamat_outlet','tlp_outlet'
    ];

    public function paket(){
        $this->hasMany(paket::class,'id_outlet');
    }
}
