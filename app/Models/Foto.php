<?php

namespace App\Models;

use App\Models\Model as ModelsModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;


class Foto extends ModelsModel
{
    protected $table = 'foto';

    public function paket()
    {
        return $this->belongsTo(PaketWisata::class,'id_paket_wisata');
    }

    public function handleUploadFoto($file)
    {
        $this->handleDelete();
        if ($file) {
            $destination = "images/paket";
            $randomStr = Str::random(5);
            $filename = time() . "-" . $randomStr . "." . $file->extension();
            $url = $file->storeAs($destination, $filename);
            $this->foto = "app/" . $url;
        }
    }

    public function handleDelete()
    {
        $foto = $this->foto; // Change 'path' to 'foto'
        if ($foto) {
            $filePath = storage_path("app/public/" . $foto);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            return true;
        }
        return false;
    }
}
