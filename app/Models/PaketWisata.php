<?php

namespace App\Models;

use App\Models\Model as ModelsModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class PaketWisata extends ModelsModel
{
    use HasFactory;
    protected $table = 'paket_wisata';

    public function user()
    {
        return $this->belongsTo(User::class,'id_user');
    }

    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class, 'id_destinasi');
    }

    public function fasilitas()
    {
        return $this->hasMany(Fasilitas::class,'id_paket_wisata');
    }

    public function aktifitas()
    {
        return $this->hasOne(Aktifitas::class,'id_paket_wisata');
    }

    public function foto()
    {
        return $this->hasMany(Foto::class,'id_paket_wisata');
    }

    function handleUploadFoto()
    {
        $this->handleDelete();
        if (request()->hasFile('foto')) {
            $foto = request()->file('foto');
            $destination = "images/paket";
            $randomStr = Str::random(5);
            $filename = time() . "-"  . $randomStr . "."  . $foto->extension();
            $url = $foto->storeAs($destination, $filename);
            $this->foto = "app/" . $url;
            $this->save();
        }
    }

    function handleDelete()
    {
        $foto = $this->foto;
        if ($foto) {
            $path = public_path($foto);
            if (file_exists($path)) {
                unlink($path);
            }
            return true;
        }
    }
}
