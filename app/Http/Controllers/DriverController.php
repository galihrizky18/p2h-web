<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Http\Requests\StoredriverRequest;
use App\Http\Requests\UpdatedriverRequest;
use App\Models\FormDocument;
use App\Models\FormEngine;
use App\Models\FormSafety;
use App\Models\FormTools;
use App\Models\Pertanyaan;
use App\Models\ReportForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = Driver::all();

        return view('admin.adminDriver', compact('data'));
    }

    public function report(){

        $dataReport = ReportForm::where('id_driver', Auth::user()->id)->get();

        return view('driver.driverReport', compact('dataReport'));
    }

    public function filterReport(Request $request){

        if($request->ajax()){
            $tanggalAwal = $request->input('tanggal_awal');
            $tanggalAkhir = $request->input('tanggal_akhir');

            $dataReport = ReportForm::where('id_driver', Auth::user()->id)->with('unit')->whereBetween('tanggal_input', [$tanggalAwal, $tanggalAkhir])->get();

            return response()->json($dataReport);
        }else{
            return response()->json('gagal');
        }


    }

    public function detailReport($id){

        $dataReport = ReportForm::where('id', $id)->first();

        $pertanyaanDocument = Pertanyaan::where('kategori', 'document')->get();
        $pertanyaanSafety = Pertanyaan::where('kategori', 'safety')->get();
        $pertanyaanEngine = Pertanyaan::where('kategori', 'engine')->get();
        $pertanyaanTools = Pertanyaan::where('kategori', 'tools')->get();

        $dataDocument = FormDocument::where('user_id', $dataReport->id_driver)->where('no_polisi', $dataReport->no_polisi)->where('shift', $dataReport->shift)->where('tgl_pemeriksaan', $dataReport->tanggal_input)->first();

        $dataSafety = FormSafety::where('user_id', $dataReport->id_driver)->where('no_polisi', $dataReport->no_polisi)->where('shift', $dataReport->shift)->where('tgl_pemeriksaan', $dataReport->tanggal_input)->first();

        $dataEngine = FormEngine::where('user_id', $dataReport->id_driver)->where('no_polisi', $dataReport->no_polisi)->where('shift', $dataReport->shift)->where('tgl_pemeriksaan', $dataReport->tanggal_input)->first();

        $dataTools = FormTools::where('user_id', $dataReport->id_driver)->where('no_polisi', $dataReport->no_polisi)->where('shift', $dataReport->shift)->where('tgl_pemeriksaan', $dataReport->tanggal_input)->first();

        return view('driver.detailReport', compact('dataDocument', 'dataSafety', 'dataEngine', 'dataTools', 'pertanyaanTools', 'pertanyaanEngine', 'pertanyaanSafety', 'pertanyaanDocument'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoredriverRequest $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_telepon' => 'required|numeric',
            'email' => 'required|email:dns',
            'kota' => 'required',
            'kode_pos' => 'required',
            'alamat' => 'required',
            'kebangsaan' => 'required',
        ],[
            'first_name.required' => 'First Name harus diisi',
            'last_name.required' => 'Last Name harus diisi',
            'gender.required' => 'Gender tidak boleh kosong',
            'tempat_lahir.required' => 'Tempat Lahir tidak boleh kosong',
            'tanggal_lahir.required' => 'Tanggal Lahir tidak boleh kosong',
            'no_telepon.required' => 'No Telepon tidak boleh kosong',
            'no_telepon.numeric' => 'No Telepon harus berupa angka',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Ini bukan format email yang benar',
            'kota.required' => 'Kota tidak boleh kosong',
            'kode_pos.required' => 'Kode Pos tidak boleh kosong',
            'alamat.required' => 'Alamat harus diisi',
            'kebangsaan.required' => 'Kebangsaan tidak boleh kosong',
        ]
        );

        // Pengecekan apakah data sudah ada di database
        if (Driver::where('first_name', $validatedData['first_name'])->exists()) {
            return redirect()->back()->withErrors(['driverAda' => 'Driver telah ada']);
        }

        Driver::create($validatedData);
        
        return redirect('/admin/driver')->with('success', 'Akun Driver berhasil diBuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(driver $driver)
    {
        return view('admin.adminEditDriver',[
            'data'=>$driver
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatedriverRequest $request, driver $driver)
    {
        $validateData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_telepon' => 'required|numeric',
            'email' => 'required|email:dns',
            'kota' => 'required',
            'kode_pos' => 'required',
            'alamat' => 'required',
            'kebangsaan' => 'required',
        ]);

        Driver::where('id', $driver->id)->update($validateData);

        return redirect('admin/driver')->with('successUpdate', 'Data Driver berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(driver $driver)
    {
    
    }
}
