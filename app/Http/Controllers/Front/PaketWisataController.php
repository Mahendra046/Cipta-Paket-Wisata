<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Aktifitas;
use App\Models\Destinasi;
use App\Models\Fasilitas;
use App\Models\Foto;
use App\Models\PaketWisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function Ramsey\Uuid\v1;

class PaketWisataController extends Controller
{

    public function destinasiForm()
    {
        return view('front.paket-wisata.destinasi.create');
    }
    public function destinasiCreate(Request $request)
    {
        $destinasi = new Destinasi;
        $destinasi->nama_destinasi = $request->nama_destinasi;
        $destinasi->alamat = $request->alamat;
        $destinasi->latitude = $request->latitude;
        $destinasi->longitude = $request->longitude;
        $destinasi->handleUploadFoto();
        $destinasi->save();

        return redirect()->route('paket.createPaketWisata', ['destinasi_id' => $destinasi->id])->with('status', [
            'type' => 'success',
            'message' => 'Destinasi berhasil ditambahkan!',
        ]);
    }

    public function createPaketWisata($destinasi_id)
    {
        $destinasi = Destinasi::find($destinasi_id);
        return view('front.paket-wisata.paket.create', compact('destinasi'));
    }

    public function storePaketWisata(Request $request)
    {
        $paketWisata = new PaketWisata();
        $paketWisata->id_destinasi = $request->destinasi_id;
        $paketWisata->nama_paket_wisata = $request->nama_paket_wisata;
        $paketWisata->deskripsi = $request->deskripsi;
        $paketWisata->durasi = $request->durasi;
        $paketWisata->jumlah_peserta = $request->jumlah_peserta;
        $paketWisata->nama_penyelenggara = $request->nama_penyelenggara;
        $paketWisata->no_wa = $request->no_wa;
        $paketWisata->instagram = $request->instagram;
        $paketWisata->facebook = $request->facebook;
        $paketWisata->handleUploadFoto();
        $paketWisata->save();

        return redirect()->route('paket.createAktivitas', ['paket_wisata_id' => $paketWisata->id])->with('status', [
            'type' => 'success',
            'message' => 'Paket wisata berhasil ditambahkan!',
        ]);
    }

    public function createAktivitas($paket_wisata_id)
    {
        $paket = PaketWisata::find($paket_wisata_id);
        return view('front.paket-wisata.paket.aktivitas.create', compact('paket'));
    }

    public function storeAktivitas(Request $request, $paket_wisata_id)
    {
        // Validasi request jika diperlukan
        // $request->validate([
        //     'daftar_aktifitas' => 'required',
        // ]);

        // Simpan aktivitas paket ke dalam database
        $aktifitas = new Aktifitas;
        $aktifitas->id_paket_wisata = $paket_wisata_id;
        $aktifitas->daftar_aktifitas = $request->daftar_aktifitas;
        $aktifitas->save();

        // Redirect ke halaman input fasilitas dengan menyertakan ID paket wisata
        return redirect()->route('paket.createFasilitas', ['paket_wisata_id' => $paket_wisata_id])
            ->with('status', [
                'type' => 'success',
                'message' => 'Aktivitas paket wisata berhasil ditambahkan!',
            ]);
    }

    public function createFasilitas($paket_wisata_id)
    {
        $paket = PaketWisata::find($paket_wisata_id);

        if (!$paket) {
            return abort(404); // Menangani jika paket wisata tidak ditemukan
        }

        return view('front.paket-wisata.paket.fasilitas.create', compact('paket'));
    }

    public function storeFasilitas(Request $request, $paket_wisata_id)
    {
        foreach ($request->nama_fasilitas as $key => $value) {
            Fasilitas::create([
                'id_paket_wisata' => $paket_wisata_id,
                'nama_fasilitas' => $request->nama_fasilitas[$key],
                'jumlah' => $request->jumlah[$key],
                'satuan' => $request->satuan[$key],
                'harga_satuan' => $request->harga_satuan[$key],
                'deskripsi_fasilitas' => $request->deskripsi_fasilitas[$key],
            ]);
        }

        return redirect()->route('paket.exportPaket', ['paket_wisata_id' => $paket_wisata_id])
            ->with('status', [
                'type' => 'success',
                'message' => 'fasilitas paket wisata berhasil ditambahkan!',
            ]);
    }

    public function exportPaket($paket_wisata_id)
    {
        $paket = PaketWisata::find($paket_wisata_id);

        $totalHarga = 0;
        foreach ($paket->fasilitas as $fasilitas) {
            $totalHarga += $fasilitas->jumlah * $fasilitas->harga_satuan;
        }
        $harga_per_orang = $totalHarga / $paket->jumlah_peserta;
        // return $paket->fasilitas;
        return view('front.paket-wisata.paket.export.index', compact('paket', 'harga_per_orang', 'totalHarga'));
    }

    public function showPaket($id)
    {
        $paket = PaketWisata::find($id);

        $totalHarga = 0;
        foreach ($paket->fasilitas as $fasilitas) {
            $totalHarga += $fasilitas->jumlah * $fasilitas->harga_satuan;
        }
        $harga_per_orang = $totalHarga / $paket->jumlah_peserta;
        // return $paket->fasilitas;
        return view('front.paket-wisata.paket.show', compact('paket', 'harga_per_orang', 'totalHarga'));
    }

    public function paket()
    {
        // $list_destinasi = Destinasi::where('id_user', auth()->user()->id)->get();
        // $list_paket = PaketWisata::where('id_user', auth()->user()->id)->get();

        // Mengembalikan data ke view
        return view('front.paket-wisata.paket.index');
    }


    public function infopaket(PaketWisata $paket)
    {
        $totalHarga = 0;
        foreach ($paket->fasilitas as $fasilitas) {
            $totalHarga += $fasilitas->jumlah * $fasilitas->harga_satuan;
        }
        $harga_per_orang = $totalHarga / $paket->jumlah_peserta;
        // return $paket->foto;
        return view('front.paket-wisata.paket.show', compact('paket', 'totalHarga', 'harga_per_orang'));
    }

    public function aktifitas(PaketWisata $paket)
    {
        // Validasi data input jika diperlukan
        // request()->validate([
        //     'daftar_aktifitas' => 'required|string',
        // ]);

        // Buat objek Aktifitas baru
        $aktifitas = new Aktifitas;
        $aktifitas->id_paket_wisata = $paket->id;
        $aktifitas->daftar_aktifitas = request('daftar_aktifitas');
        // Simpan data aktifitas ke database
        $aktifitas->save();

        // Kembalikan respon dengan pesan sukses
        return back()->with('status', [
            'type' => 'success',
            'message' => 'Data berhasil disimpan!',
        ]);
    }
    public function Editaktifitas(PaketWisata $paket, $aktifitas)
    {
        $aktifitas = Aktifitas::find($aktifitas);
        $aktifitas->id_paket_wisata = $paket->id;
        $aktifitas->daftar_aktifitas = request('daftar_aktifitas');
        return $aktifitas;
        $aktifitas->save();
        return back()->with('status', [
            'type' => 'success',
            'message' => 'Data berhasil diupdate!',
        ]);
    }
}
