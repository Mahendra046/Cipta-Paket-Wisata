<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['list_admin'] = Admin::all();
        return view('admin.master-data.admin.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master-data.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $admin = new Admin;
        $admin->name = request('name');
        $admin->email = request('email');
        $admin->password = request('password');
        $admin->save();
        return redirect('superuser/master-data/admin')->with('success','admin berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.master-data.admin.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        return view('admin.master-data.admin.edit', ['admin'=> $admin]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $admin->name = request('name');
        $admin->email = request('email');
        $admin->password = request('password');
        $admin->level = request('level');
        $admin->save();
        return redirect('superuser/master-data/admin')->with('success','admin berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return back()->with('danger','admin telah dihapus');
    }
}
