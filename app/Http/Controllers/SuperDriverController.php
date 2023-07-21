<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Http\Requests\StoredriverRequest;
use App\Http\Requests\UpdatedriverRequest;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperDriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = Driver::all();

        return view('superAdmin.superAdminDriver', compact('data'));
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

        $log = new ActivityLog();
        $log->login_time = session()->get('login_time', 'default');
        $log->user_id = Auth::user()->id;
        $log->user_level = 'super_admin';
        $log->action = 'input_driver';
        $log->description = 'Input Driver ke Sistem';
        $log->save();
        
        return redirect('/super-admin/driver')->with('success', 'Akun Driver berhasil diBuat');
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
        return view('superAdmin.adminEditDriver',[
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

        $log = new ActivityLog();
        $log->login_time = session()->get('login_time', 'default');
        $log->user_id = Auth::user()->id;
        $log->user_level = 'super_admin';
        $log->action = 'update_driver';
        $log->description = 'Update Data Driver d Sistem';
        $log->save();

        return redirect('super-admin/driver')->with('successUpdate', 'Data Driver berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(driver $driver)
    {

        $driv=Driver::find($driver->id);
        $userDriver = User::where('driver_id', $driv);
    
        if(!$userDriver){
            Driver::destroy($driver->id);
        } else{
            if ($driv->user) {
                $driv->user->delete();
            }
            User::where('driver_id', $driver->id)->delete();
            Driver::where('id', $driver->id)->delete();
        }

        $log = new ActivityLog();
        $log->login_time = session()->get('login_time', 'default');
        $log->user_id = Auth::user()->id;
        $log->user_level = 'super_admin';
        $log->action = 'hapus_driver';
        $log->description = 'Hapus Data Driver dari Sistem';
        $log->save();

        return redirect('/super-admin/driver')->with('successDelete', 'Driver berhasil di hapus');
    }
}
