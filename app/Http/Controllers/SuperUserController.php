<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Admin;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function inputAkunDriver(){
        $dataDriver = Driver::all();
        return view('superAdmin.adminInputAkunDriver', compact('dataDriver'));
    }

    public function storeAkunDriver(Request $request){

        $validateData = $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'email' => 'required|email',
            'id_driver' => 'required',
        ],[
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username sudah dipakai',
            'password.required' => 'Password harus diisi',
            'email.required' => 'Email harus diisi',
            'id_driver.required' => 'Id Driver tidak boleh kosong',
        ]
        );

        $data = new User();
        $data->username = $validateData["username"];
        $data->password = bcrypt($validateData["password"]);
        $data->email = $validateData["email"];
        $data->driver_id = $validateData["id_driver"];
        $data->level = 'driver';

         // Pengecekan apakah email sudah ada di database
        if (User::where('driver_id', $validateData['id_driver'])->exists()) {
            return redirect()->back()->withErrors(['akunDriverAda' => 'Akun Driver telah ada']);
        }

        $data->save();

        $log = new ActivityLog();
        $log->login_time = session()->get('login_time', 'default');
        $log->user_id = Auth::user()->id;
        $log->user_level = 'super_admin';
        $log->action = 'input_driver';
        $log->description = 'Input Driver ke Sistem';
        $log->save();
        
        return redirect('/super-admin/driver')->with('successAkunDriver', 'Driver berhasil ditambahkan');

    }

    public function inputAkunAdmin(){
        $dataAdmin = Admin::all();
        return view('superAdmin.superAdminInputAkunAdmin', compact('dataAdmin'));
    }

    public function storeAkunAdmin(Request $request){

        $validateData = $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'email' => 'required|email',
            'id_admin' => 'required',
        ],[
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username sudah dipakai',
            'password.required' => 'Password harus diisi',
            'email.required' => 'Email harus diisi',
            'id_admin.required' => 'Id Admin tidak boleh kosong',
        ]
        );

        $data = new User();
        $data->username = $validateData["username"];
        $data->password = bcrypt($validateData["password"]);
        $data->email = $validateData["email"];
        $data->admin_id = $validateData["id_admin"];
        $data->level = 'admin';

         // Pengecekan apakah email sudah ada di database
        if (User::where('admin_id', $validateData['id_admin'])->exists()) {
            return redirect()->back()->withErrors(['adminAda' => 'Akun Admin telah ada']);
        }

        $data->save();

        $log = new ActivityLog();
        $log->login_time = session()->get('login_time', 'default');
        $log->user_id = Auth::user()->id;
        $log->user_level = 'super_admin';
        $log->action = 'input_user_admin';
        $log->description = 'Input Akun User Admin ke Sistem';
        $log->save();
        
        return redirect('/super-admin/admin')->with('successAkunAdmin', 'Admin berhasil ditambahkan');

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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        
    }
}
