<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('front.profil.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {

        // $user->han

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'email' => 'required|unique:users,email,' . $id,
        //     // Tambahkan validasi lainnya
        // ]);

        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->no_wa = $request->input('no_wa');
        $user->instagram = $request->input('instagram');
        $user->facebook = $request->input('facebook');

        // Memeriksa apakah password baru tidak kosong dan berbeda dari password yang sudah ada
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        if ($request->hasFile('foto')) {
            $user->handleUploadFoto();
        }

        $user->save();

        return redirect()->back()->with('status', [
            'type' => 'success',   
            'message' => 'Data berhasil diupdate!',
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
