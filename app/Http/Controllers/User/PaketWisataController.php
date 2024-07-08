<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use App\Models\PaketWisata;
use Illuminate\Http\Request;

class PaketWisataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexPaket()
    {
        $list_paket = PaketWisata::where('id_user', auth()->user()->id)
            ->latest()
            // ->take(6)
            ->get();
        $totalHarga = 0;
        $harga_per_orang = 0;
        if ($list_paket->isNotEmpty()) {
            foreach ($list_paket as $paket) {
                if ($paket->fasilitas && $paket->fasilitas->isNotEmpty()) {
                    foreach ($paket->fasilitas as $fasilitas) {
                        $totalHarga += $fasilitas->jumlah * $fasilitas->harga_satuan;
                    }
                    $harga_per_orang = $paket->jumlah_peserta > 0 ? $totalHarga / $paket->jumlah_peserta : 0;
                    $paket->harga_per_orang = $harga_per_orang;
                }
            }
        }

        $list_destinasi = Destinasi::where('id_user', auth()->user()->id)->get();

        return view('users-backend.paket-wisata.index', compact('list_paket', 'list_destinasi', 'totalHarga', 'harga_per_orang'));
    }

    public function filter(Request $request)
    {
        $keyword = $request->input('keyword');

        $list_paket = PaketWisata::where('id_user', auth()->user()->id)
            ->where('nama_paket_wisata', 'like', '%' . $keyword . '%') // Filter berdasarkan nama paket
            ->get();

        $totalHarga = 0;
        $harga_per_orang = 0;
        if ($list_paket->isNotEmpty()) {
            foreach ($list_paket as $paket) {
                if ($paket->fasilitas && $paket->fasilitas->isNotEmpty()) {
                    foreach ($paket->fasilitas as $fasilitas) {
                        $totalHarga += $fasilitas->jumlah * $fasilitas->harga_satuan;
                    }
                    $harga_per_orang = $paket->jumlah_peserta > 0 ? $totalHarga / $paket->jumlah_peserta : 0;
                    $paket->harga_per_orang = $harga_per_orang;
                }
            }
        }
        // Tampilkan hasil filter ke halaman view yang sesuai
        $list_destinasi = Destinasi::where('id_user', auth()->user()->id)->get();
        return view('users-backend.paket-wisata.index', compact('list_paket', 'list_destinasi', 'totalHarga', 'harga_per_orang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function tambahpaket($destinasi)
    {
        $paket = new PaketWisata;
        $paket->id_user = auth()->user()->id;
        $paket->id_destinasi = $destinasi;
        $paket->nama_paket_wisata = request('nama_paket_wisata');
        $paket->deskripsi = request('deskripsi');
        $paket->durasi = request('durasi');
        $paket->jumlah_peserta = request('jumlah_peserta');
        $paket->handleUploadFoto();
        $paket->save();
        return back()->with('light', 'paket berhasil ditambahkan silakan tambahkan aktifitas dan fasilitas untuk paket anda');
    }

    public function tambahpaket2()
    {
        $paket = new PaketWisata;
        $paket->id_user = auth()->user()->id;
        $paket->id_destinasi = request('id_destinasi');
        $paket->nama_paket_wisata = request('nama_paket_wisata');
        $paket->deskripsi = request('deskripsi');
        $paket->durasi = request('durasi');
        $paket->jumlah_peserta = request('jumlah_peserta');
        // $paket->nama_penyelenggara = request('nama_penyelenggara');
        // $paket->kontak_penyelenggara = request('kontak_penyelenggara');
        $paket->handleUploadFoto();
        $paket->save();
        return back()->with('light', 'paket berhasil ditambahkan silakan tambahkan aktifitas dan fasilitas untuk paket anda');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($destinasi)
    {
        $paket = new PaketWisata;
        $paket->id_user = auth()->user()->id;
        $paket->id_destinasi = $destinasi;
        $paket->nama_paket_wisata = request('nama_paket_wisata');
        $paket->deskripsi = request('deskripsi');
        $paket->durasi = request('durasi');
        $paket->jumlah_peserta = request('jumlah_peserta');
        $paket->handleUploadFoto();
        $paket->save();
        return back()->with('light', 'paket berhasil ditambahkan silakan tambahkan aktifitas dan fasilitas untuk paket anda');
    }

    /**
     * Display the specified resource.
     */
    public function hapusPaket(PaketWisata $paket)
    {
        $paket->delete();
        return back()->with('danger', 'Paket Telah dihapus');
    }

    public function infoPaket(PaketWisata $paket)
    {

        $totalHarga = 0;
        foreach ($paket->fasilitas as $fasilitas) {
            $totalHarga += $fasilitas->jumlah * $fasilitas->harga_satuan;
        }
        $harga_per_orang = $totalHarga / $paket->jumlah_peserta;
        $foto = $paket->destinasi->foto;
        return view('users-backend.fasilitas.create', compact('paket', 'totalHarga', 'harga_per_orang'), compact('foto'));
    }

    public function infoPaket1(PaketWisata $paket)
    {

        $totalHarga = 0;
        foreach ($paket->fasilitas as $fasilitas) {
            $totalHarga += $fasilitas->jumlah * $fasilitas->harga_satuan;
        }
        $harga_per_orang = $totalHarga / $paket->jumlah_peserta;
        $foto = $paket->destinasi->foto;
        return view('users-backend.paket-wisata.show', compact('paket', 'totalHarga', 'harga_per_orang'), compact('foto'));
    }

    public function fotoPaket(PaketWisata $paket)
    {
        $paket->handleUploadFoto();
        $paket->save();
        return back()->with('light', 'foto berhasil diperbarui');
        // return $paket;
    }
    public function dataPaket(PaketWisata $paket)
    {
        $paket->nama_paket_wisata = request('nama_paket_wisata');
        $paket->jumlah_peserta = request('jumlah_peserta');
        $paket->durasi = request('durasi');
        $paket->deskripsi = request('deskripsi');
        $paket->update();
        // return $paket;
        return back()->with('light', 'data paket berhasil diperbarui');
        // return $paket;
    }
    public function kontakPaket(PaketWisata $paket)
    {
        $paket->nama_penyelenggara = request('nama_penyelenggara');
        $paket->kontak_penyelenggara = request('kontak_penyelenggara');
        $paket->save();
        return back()->with('light', 'kontak berhasil diperbarui');
        // return $paket;
    }
    public function levelPaket(Request $request, $id)
    {
        $paket = PaketWisata::find($id);
        $statusPaket = $request->input('status_paket');
        $paket->status_paket = $statusPaket;
        $paket->save();
        $notificationMessage = '';

        switch ($statusPaket) {
            case 3:
                $notificationMessage = 'Paket siap dipublikasikan.';
                break;
            case 4:
                $notificationMessage = 'Paket telah diterbitkan.';
                break;
            case 5:
                $notificationMessage = 'Paket telah diarsipkan.';
                break;
            default:
                $notificationMessage = 'Status paket berhasil diperbarui.';
        }

        return back()->with('light', $notificationMessage);
        // return $paket;
    }
}
