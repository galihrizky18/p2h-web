<?php

namespace App\Http\Controllers;

use App\Models\Bengkel;
use App\Http\Requests\StoreBengkelRequest;
use App\Http\Requests\UpdateBengkelRequest;

class BengkelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Bengkel::all();

        return view('admin.adminBengkel', compact('data'));
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
    public function store(StoreBengkelRequest $request)
    {
        $validateData = $request->validate([
            'nama_mitra' => 'required',
            'no_telepon' => 'required',
            'email' => 'required|email:dns',
            'alamat' => 'required',
            'kode_pos' => 'required',
        ],[
            'nama_mitra.required' => 'Nama Mitra tidak boleh kosong',
            'no_telepon.required' => 'No Telepon tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email tidak sesuai',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'kode_pos.required' => 'Kode Pos tidak boleh kosong',
        ]
        );

        Bengkel::create($validateData);

        return redirect('admin/bengkel')->with('success', 'Data Bengkel berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bengkel $bengkel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bengkel $bengkel)
    {
        return view('admin.adminEditBengkel', compact('bengkel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBengkelRequest $request, Bengkel $bengkel)
    {
        $validateData = $request->validate([
            'nama_mitra' => 'required',
            'no_telepon' => 'required',
            'email' => 'required|email:dns',
            'alamat' => 'required',
            'kode_pos' => 'required',
        ]);

        Bengkel::where('id', $bengkel->id)->update($validateData);
        
        return redirect('/admin/bengkel')->with('successUpdate', 'Data Bengkel berhasil diUpdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bengkel $bengkel)
    {
        $bengkel->delete();

        return redirect('/admin/bengkel')->with('successDelete', 'Bengkel Berhasil diHapus');
    }
}
