<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Unit::all();

        return view('admin.adminUnit', compact('data'));
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
    public function store(StoreUnitRequest $request)
    {
        $validateData = $request->validate([
            'no_polisi' => 'required|unique:units,no_polisi',
            'merk_mobil' => 'required',
            'model_mobil' => 'required',
            'warna' => 'required',
            'no_mesin' => 'required',
            'tahun_pembuatan' => 'required',
        ],[
            'no_polisi.required' => 'No Polisi tidak boleh kosong',
            'merk_mobil.required' => 'Merk Mobil tidak boleh kosong',
            'model_mobil.required' => 'Model Mobil tidak boleh kosong',
            'warna.required' => 'Warna tidak boleh kosong',
            'no_mesin.required' => 'No Mesin tidak boleh kosong',
            'tahun_pembuatan.required' => 'Tahun Pembuatan tidak boleh kosong',
        ]
        );

        // Pengecekan apakah data sudah ada di database
        if (Unit::where('no_polisi', $validateData['no_polisi'])->exists()) {
            return redirect()->back()->withErrors(['unitAda' => 'Unit sudah ada']);
        }

        Unit::create($validateData);
        

        return redirect('/admin/unit')->with('success', 'Unit berhasil di input');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        return view('admin.adminEditUnit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        $validateData = $request->validate([
            'no_polisi' => 'required',
            'merk_mobil' => 'required',
            'model_mobil' => 'required',
            'warna' => 'required',
            'no_mesin' => 'required',
            'tahun_pembuatan' => 'required',
        ]);

        Unit::where('id', $unit->id)->update($validateData);

        return redirect('admin/unit')->with('successUpdate', 'Data Unit berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
    }
}
