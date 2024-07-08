<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Aktifitas;
use App\Models\Destinasi;
use App\Models\Fasilitas;
use App\Models\PaketWisata;
use Illuminate\Http\Request;
use App\Policies\DestinasiPolicy;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\BackupGlobals;

class DestinasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data['destinasi'] = Destinasi::where('id_user', auth()->user()->id)->get();
        $data['destinasi'] = Destinasi::where('id_user', auth()->user()->id)
            ->orderBy('created_at', 'desc') // Atau kolom lain sesuai kebutuhan
            ->get();
        return view('users-backend.destinasi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('users-backend.destinasi.create');
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $destinasi = new Destinasi;
        $destinasi->id_user = auth()->user()->id;
        $destinasi->latitude = request('latitude');
        $destinasi->longitude = request('longitude');
        $destinasi->alamat = request('alamat');
        $destinasi->nama_destinasi = request('nama_destinasi');
        $destinasi->handleUploadFoto();
        $destinasi->save();
        return back()->with('light', 'destinasi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $destinasi = Destinasi::where('id', $id)
            ->where('id_user', auth()->user()->id)
            ->first();

        if ($destinasi) {
            // Destinasi ditemukan, tampilkan formulir pengeditan
            return view('users-backend.destinasi.edit', compact('destinasi'));
        } else {
            // Destinasi tidak ditemukan, tampilkan halaman 404
            abort(404, 'Destinasi tidak ditemukan');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateGambar(Destinasi $destinasi)
    {
        if (request('foto')) $destinasi->handleUploadFoto();
        $destinasi->save();
        return back()->with('light', 'foto berhasil ditambahkan');
    }

    public function update(Request $request, Destinasi $destinasi)
    {
        $validator = Validator::make($request->all(), [
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'alamat' => 'required|string',
            'nama_destinasi' => 'required|string',
            // Tambahkan validasi untuk foto jika diperlukan
        ]);

        // Cek validasi
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $destinasi->latitude = request('latitude');
        $destinasi->longitude = request('longitude');
        $destinasi->alamat = request('alamat');
        $destinasi->nama_destinasi = request('nama_destinasi');
        // $destinasi->foto()
        $destinasi->save();
        return back()->with('success', 'destinasi berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destinasi $destinasi)
    {
        $destinasi->handleDelete();
        $destinasi->delete();
        return back()->with('danger', 'destinasi telah dihapus');
    }

    public function show($id)
    {
        $list_paket = PaketWisata::where('id_destinasi', $id)->where('id_user', auth()->user()->id)->get();
        $destinasi = Destinasi::where('id', $id)
            ->where('id_user', auth()->user()->id)
            ->first();

        if ($destinasi) {
            // Destinasi ditemukan, tampilkan formulir pengeditan
            return view('users-backend.destinasi.info', compact('destinasi'), compact('list_paket'));
        } else {
            // Destinasi tidak ditemukan, tampilkan halaman 404
            abort(404, 'Destinasi tidak ditemukan');
        }
    }

    public function tambahAktifitas($paket)
    {
        $aktifitas = new Aktifitas;
        $aktifitas->id_paket_wisata = $paket;
        $aktifitas->daftar_aktifitas = request('daftar_aktifitas');
        // return $aktifitas;
        $aktifitas->save();
        return back()->with('light', 'data aktifitas berhasil ditambahkan');
    }

    public function editAktifitas(PaketWisata $paket, $id)
    {
        $aktifitas = Aktifitas::find($id);
        $aktifitas->daftar_aktifitas = request('daftar_aktifitas');
        // return $aktifitas;
        $aktifitas->save();
        return back()->with('light', 'data aktifitas berhasil diubah');
    }

    public function tambahFasilitas($paket, Request $request)
    {
        foreach ($request->nama_fasilitas as $key => $value) {
            Fasilitas::create([
                'id_paket_wisata' => $paket,
                'nama_fasilitas' => $request->nama_fasilitas[$key],
                'jumlah' => $request->jumlah[$key],
                'satuan' => $request->satuan[$key],
                'harga_satuan' => $request->harga_satuan[$key],
                'deskripsi_fasilitas' => $request->deskripsi_fasilitas[$key],
            ]);
        }

        $paketwisata = PaketWisata::find($paket);
        if ($paketwisata) {
            $paketwisata->status_paket = '2';
            $paketwisata->save(); // Pastikan untuk menyimpan perubahan
        }

        return back()->with('status', [
            'type' => 'success',
            'message' => 'Data berhasil disimpan!',
        ]);
    }

    public function deleteFasilitas(Fasilitas $fasilitas)
    {
        $fasilitas->delete();
        return back()->with('danger', 'fasilitas telah dihapus');
    }

    public function deleteallFasilitas($id)
    {
        // Menghapus semua fasilitas yang berhubungan dengan ID paket
        Fasilitas::where('id_paket_wisata', $id)->delete();

        return back()->with('status', [
            'type' => 'error',
            'message' => 'Data telah dihapus!',
        ]);
    }
}
