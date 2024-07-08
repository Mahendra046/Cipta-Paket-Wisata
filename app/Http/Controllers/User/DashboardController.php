<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use App\Models\PaketWisata;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $destinasi = Destinasi::where('id_user',$user->id)->get();
        $paket = PaketWisata::where('id_user', $user->id)->get();
        return view('users-backend.dashboard.index',compact('destinasi'), compact('paket'));
    }

    public function welcome()
    {
        return view('users-backend.dashboard.welcome');
    }
}
