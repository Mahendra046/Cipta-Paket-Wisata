<?php

namespace App\Models;

use App\Models\Model as ModelsModel;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Destinasi extends ModelsModel
{
    protected $table = 'destinasi';

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function paket()
    {
        return $this->hasMany(PaketWisata::class,'id_destinasi');
    }

    function handleUploadFoto()
    {
        $this->handleDelete();
        if (request()->hasFile('foto')) {
            $foto = request()->file('foto');
            $destination = "images/destinasi";
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

    static $field = [
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'alamat' => 'required|string',
        'nama_destinasi' => 'required|string',
    ];

    static $pesan = [
        "latitude.required" => 'Data tidak boleh kosong !',
        "longitude.required" => 'Data tidak boleh kosong !',
        "alamat.required" => 'Data tidak boleh kosong !',
        "nama_destinasi.required" => 'Data tidak boleh kosong !',
    ];
}
