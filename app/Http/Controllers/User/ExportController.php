<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use App\Models\PaketWisata;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use Spatie\Browsershot\Browsershot;

class ExportController extends Controller
{
    public function index()
    {
        $data['list_destinasi'] = Destinasi::with('paket')->where('id_user', auth()->user()->id)->get();
        // return $data;
        return view('users-backend.export.index', $data);
    }

    public function destinasi($destinasi)
    {
        $destinasi = Destinasi::find($destinasi);

        if (!$destinasi) {
            abort(404); // Destinasi tidak ditemukan, mungkin perlu menangani ini sesuai kebutuhan aplikasi Anda
        }

        $paket = PaketWisata::where('id_destinasi', $destinasi->id)->first();

        if (!$paket) {
            abort(404); // Paket wisata untuk destinasi ini tidak ditemukan
        }

        $totalHarga = 0;
        if ($paket->fasilitas) {
            foreach ($paket->fasilitas as $fasilitas) {
                $totalHarga += $fasilitas->jumlah * $fasilitas->harga_satuan;
            }
        }

        $harga_per_orang = $paket->jumlah_peserta > 0 ? $totalHarga / $paket->jumlah_peserta : 0;

        return view('users-backend.export.destinasi', compact('destinasi', 'paket', 'harga_per_orang', 'totalHarga'));
    }



    public function exportDestinasi($destinasiId)
    {
        $destinasi = Destinasi::find($destinasiId);
        return view('users-backend.export.export');
        if (!$destinasi) {
            abort(404); // Destinasi tidak ditemukan
        }

        $pakets = PaketWisata::where('id_destinasi', $destinasi->id)->get();
        $paketsComplete = [];

        $totalHarga = 0;
        $totalJumlahPeserta = 0;

        foreach ($pakets as $paket) {
            if ($paket->fasilitas->isNotEmpty() && $paket->aktifitas != null) {
                $paketsComplete[] = $paket;

                foreach ($paket->fasilitas as $fasilitas) {
                    $totalHarga += $fasilitas->jumlah * $fasilitas->harga_satuan;
                }

                $totalJumlahPeserta += $paket->jumlah_peserta;
            }
        }

        $harga_per_orang = $totalJumlahPeserta > 0 ? $totalHarga / $totalJumlahPeserta : 0;

        // Membuat objek Dompdf
        $pdf = new Dompdf();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $pdf->setOptions($options);

        // Mengambil view destinasi.blade.php dan menyimpannya ke dalam variabel html
        $html = view('users-backend.export.export', compact('destinasi', 'paketsComplete', 'totalHarga', 'harga_per_orang'))->render();

        // Memuat konten HTML ke dalam objek Dompdf
        $pdf->loadHtml($html);

        // Render PDF
        $pdf->render();

        // Mengirim file PDF sebagai respons download
        return $pdf->stream('destinasi.pdf');
    }

    public function generatepdf()
    {
        $url = 'users-backend.export.export';
        $pdfPath = 'temp/' . uniqid() . '.pdf'; // Folder 'temp' di dalam storage

        $url = 'https://www.example.com';

        $pdf = Browsershot::url($url)
            ->format('A4')
            ->pdf();
    
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf;
        }, 'downloaded-file.pdf');
    }
}
