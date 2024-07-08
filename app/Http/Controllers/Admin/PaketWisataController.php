<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaketWisata;
use Illuminate\Http\Request;

class PaketWisataController extends Controller
{
    public function index()
    {
        $data['paket_wisata'] = PaketWisata::latest()->get();
        return view('admin.paket_wisata.index',$data);
    }


    public function show($id)
    {   
        $paket = PaketWisata::find($id);
        $totalHarga = 0;
        foreach ($paket->fasilitas as $fasilitas) {
            $totalHarga += $fasilitas->jumlah * $fasilitas->harga_satuan;
        }
        $harga_per_orang = $totalHarga / $paket->jumlah_peserta;
        $foto = $paket->foto;
        return view('admin.paket_wisata.show', compact('paket', 'totalHarga', 'harga_per_orang'), compact('foto'));
    }
}
