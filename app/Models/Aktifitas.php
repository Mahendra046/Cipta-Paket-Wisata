<?php

namespace App\Models;

use App\Models\Model as ModelsModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktifitas extends ModelsModel
{
    use HasFactory;

    protected $table = 'aktifitas';

    public function paket()
    {
        return $this->belongsTo(PaketWisata::class,'id_paket_wisata');
    }    
}
