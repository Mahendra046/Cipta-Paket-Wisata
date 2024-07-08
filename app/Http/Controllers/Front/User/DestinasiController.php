<?php

namespace App\Http\Controllers\Front\User;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use Illuminate\Http\Request;

class DestinasiController extends Controller
{
    public function index()
    {
        $data['list_destinasi'] = Destinasi::where('id_user', auth()->user()->id)->get();
        return view('front.paket-wisata.destinasi.index',$data);
    }

    public function create()
    {
        return view('front.paket-wisata.destinasi.create');
    }

    public function store(Request $request)
    {
        $destinasi = new Destinasi;
        $destinasi->id_user = auth()->user()->id;
        $destinasi->nama_destinasi = $request->nama_destinasi;
        $destinasi->alamat = $request->alamat;
        $destinasi->latitude = $request->latitude;
        $destinasi->longitude = $request->longitude;
        $destinasi->handleUploadFoto();
        $destinasi->save();
        return redirect('paket-destinasi')->with('status', [
            'type' => 'success',   
            'message' => 'Destinasi berhasil ditambahkan!',
        ]);
    }
}
