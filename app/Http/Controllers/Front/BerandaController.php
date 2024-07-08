<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\PaketWisata;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $data['list_paket'] = PaketWisata::where('status_paket','3')->get();
        return view('front.beranda.index',$data);
    }
}
