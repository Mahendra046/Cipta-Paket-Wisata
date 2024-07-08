<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class User extends ModelAuthenticate
{
    // use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function destinasi()
    {
        return $this->hasMany(Destinasi::class);
    }

    function handleUploadFoto()
    {
        $this->handleDelete();
        if (request()->hasFile('foto')) {
            $foto = request()->file('foto');
            $destination = "images/user";
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

    // public function canAccessDestinasi($destinasiId)
    // {
    //     // Anda dapat mengganti logika berikut sesuai dengan aturan akses Anda
    //     $destinasi = Destinasi::find($destinasiId);

    //     if ($destinasi) {
    //         // Contoh: Cek apakah pengguna memiliki akses ke destinasi tertentu
    //         return $this->id === $destinasi->id_user;
    //     }

    //     return false;
    // }

    // public static $rules = [
    //     'email' => 'required|email|unique:users,email',
    //     // Aturan lainnya
    // ];
}
