<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RencanaPerjalananController extends Controller
{
    public function index()
    {
        return view('front.rencana-perjalanan.index');
    }
}
