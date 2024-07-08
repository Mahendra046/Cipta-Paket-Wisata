<?php

namespace App\Models;

use App\Models\Model as ModelsModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fasilitas extends ModelsModel
{
    use HasFactory;
    protected $table = 'fasilitas';

    protected $fillable = [
        'id_paket_wisata',
        'nama_fasilitas',
        'jumlah',
        'satuan',
        'harga_satuan',
        'deskripsi_fasilitas',
    ];
    
    public function paket()
    {
        return $this->belongsTo(PaketWisata::class,'id_paket_wisata');
    }
}
