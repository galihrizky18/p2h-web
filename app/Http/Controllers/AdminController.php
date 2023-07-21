<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\ActivityLog;
use App\Models\Bengkel;
use App\Models\FormDocument;
use App\Models\FormEngine;
use App\Models\FormSafety;
use App\Models\FormTools;
use App\Models\Perbaikan;
use App\Models\Pertanyaan;
use App\Models\ReportForm;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Psy\Readline\Hoa\Console;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Admin::all();
        return view('superAdmin.superAdminAdmin', compact('data'));
    }

    public function tesComiit(){
        
    }

    // SUPER ADMIN
    public function superDetailReport($id){

        $dataReport = ReportForm::where('id', $id)->first();

        $pertanyaanDocument = Pertanyaan::where('kategori', 'document')->get();
        $pertanyaanSafety = Pertanyaan::where('kategori', 'safety')->get();
        $pertanyaanEngine = Pertanyaan::where('kategori', 'engine')->get();
        $pertanyaanTools = Pertanyaan::where('kategori', 'tools')->get();

        $dataDocument = FormDocument::where('user_id', $dataReport->id_driver)->where('no_polisi', $dataReport->no_polisi)->where('shift', $dataReport->shift)->where('tgl_pemeriksaan', $dataReport->tanggal_input)->first();

        $dataSafety = FormSafety::where('user_id', $dataReport->id_driver)->where('no_polisi', $dataReport->no_polisi)->where('shift', $dataReport->shift)->where('tgl_pemeriksaan', $dataReport->tanggal_input)->first();

        $dataEngine = FormEngine::where('user_id', $dataReport->id_driver)->where('no_polisi', $dataReport->no_polisi)->where('shift', $dataReport->shift)->where('tgl_pemeriksaan', $dataReport->tanggal_input)->first();

        $dataTools = FormTools::where('user_id', $dataReport->id_driver)->where('no_polisi', $dataReport->no_polisi)->where('shift', $dataReport->shift)->where('tgl_pemeriksaan', $dataReport->tanggal_input)->first();

        return view('superAdmin.superDetailReport', compact('dataDocument', 'dataSafety', 'dataEngine', 'dataTools', 'pertanyaanTools', 'pertanyaanEngine', 'pertanyaanSafety', 'pertanyaanDocument', 'dataReport'));
    }
    public function superReportForm(Request $request){

        $dataReport = ReportForm::all();
        return view('superAdmin.adminReportForm', compact('dataReport'));
        
    }
    // Filter admin
    public function filterReportAdmin(Request $request){

        if($request->ajax()){
            $tanggalAwal = $request->input('tanggal_awal');
            $tanggalAkhir = $request->input('tanggal_akhir');
    
            $dataReport = ReportForm::with('unit')->whereBetween('tanggal_input', [$tanggalAwal, $tanggalAkhir])->get();
            return response()->json($dataReport);
        }else{

            return response()->json('gagal');
        }
    }
    public function filterPerbaikanAdmins(Request $request){

        if($request->ajax()){
            $tanggalAwal = $request->input('tanggal_awal');
            $tanggalAkhir = $request->input('tanggal_akhir');
    
            $dataReport = Perbaikan::whereBetween('tanggal_perbaikan', [$tanggalAwal, $tanggalAkhir])->get();

            return response()->json($dataReport);
        }else{
            return response()->json('gagal');
        }


    }
    public function filterPerbaikanSelesaiAdmin(Request $request){

        if($request->ajax()){
            $tanggalAwal = $request->input('tanggal_awal');
            $tanggalAkhir = $request->input('tanggal_akhir');
    
            $dataReport = Perbaikan::whereBetween('tanggal_selesai', [$tanggalAwal, $tanggalAkhir])->get();

            return response()->json($dataReport);
        }else{
            return response()->json('gagal');
        }


    }
    // Filter Super Admin
    public function filterReportSuper(Request $request){

        if($request->ajax()){
            $tanggalAwal = $request->input('tanggal_awal');
            $tanggalAkhir = $request->input('tanggal_akhir');
    
            $dataReport = ReportForm::with('unit')->whereBetween('tanggal_input', [$tanggalAwal, $tanggalAkhir])->get();

            return response()->json($dataReport);
    
        }else{

            return response()->json('gagal');
        }

    }
    public function filterPerbaikanSuper(Request $request){


        // MASIH ERROR 
        if($request->ajax()){
            $tanggalAwal = $request->input('tanggal_awal');
            $tanggalAkhir = $request->input('tanggal_akhir');
    
            $dataReport = Perbaikan::whereBetween('tanggal_perbaikan', [$tanggalAwal, $tanggalAkhir])->get();

            return response()->json($dataReport, 200);
        }else{
            return response()->json('gagal');
        }


    }
    public function filterPerbaikanSelesaiSuper(Request $request){

        if($request->ajax()){
            $tanggalAwal = $request->input('tanggal_awal');
            $tanggalAkhir = $request->input('tanggal_akhir');
    
            $dataReport = Perbaikan::whereBetween('tanggal_selesai', [$tanggalAwal, $tanggalAkhir])->get();

            return response()->json($dataReport);
        }else{
            return response()->json('gagal');
        }


    }
    public function superPerbaikan(){

        $dataPerbaikan = Perbaikan::all();

        return view('superAdmin.adminPerbaikanForm', compact('dataPerbaikan'));
    }
    public function inputPerbaikanSuper($id){

        $dataReport = ReportForm::where('id', $id)->first();
        $dataBengkel = Bengkel::all();

        return  view('superAdmin.superInputPerbaikan', compact('dataReport', 'dataBengkel'));
    }
    public function storePerbaikanSuper(Request $request, $id){

        

        $dataForm = ReportForm::where('id', $id)->first();

        $request->validate([
            'mitra' => 'required',
            'tanggal_perbaikan' => 'required',
            'no_polisi' => 'required',
        ],[
            'mitra.required' => 'Mitra Bengkel harus dipilih',
            'tanggal_perbaikan.required' => 'Tanggal Perbaikan harus diisi',
            'no_polisi.required' => 'No Polisi harus diisi',
        ]
        );

        $data = new Perbaikan();
        $data->id_report = $id;
        $data->no_polisi = $request->no_polisi;
        $data->nama_driver = $dataForm->nama_driver;
        $data->mitra_bengkel = $request->mitra;
        $data->tanggal_perbaikan = $request->tanggal_perbaikan;

        $data->save();

        $log = new ActivityLog();
        $log->login_time = session()->get('login_time', 'default');
        $log->user_id = Auth::user()->id;
        $log->user_level = 'super_admin';
        $log->action = 'input_perbaikan';
        $log->description = 'Input Perbaikan ke Sistem';
        $log->save();

        return redirect()->route('perbaikanSuper')->with('success', 'Perbaikan berhasil disimpan');


    }
    public function updatePerbaikanSuper($id){

        $dataPerbaikan = Perbaikan::where('id', $id)->first();

        return view('superAdmin.superUpdatePerbaikan', compact('dataPerbaikan'));
    }
    public function storeUpdatePerbaikanSuper(Request $request, $id){

        $request->validate([
            'tanggal_selesai' => 'required',
            'biaya' => 'required',
            'nota.*' => 'required|file|mimes:jpeg,jpg,png,pdf|max:10240'
        ],[
            'tanggal_selesai.required' => 'Tanggal Selesai tidak boleh Kosong',
            'biaya.required' => 'Biaya harus diisi',
            'nota.*.required' => 'Nota Harus di Upload',
            'nota.*.file' => 'File yang diunggah harus berupa file',
            'nota.*.mimes' => 'Format file harus berupa jpeg, jpg, png, atau pdf',
            'nota.*.max' => 'Ukuran file maksimal 10 MB',
        ]);

        
        $cekData = Perbaikan::where('id', $id)->first();
        if($cekData->nota){

            $nota = explode(',', $cekData->nota);

            foreach($nota as $n){
                Storage::delete('public/nota/' . trim($n));
            }
            
        }

        // untuk menyimpan kedalam folder upload 
        $file_paths = [];
        if ($request->hasFile('nota')) {
            foreach ($request->file('nota') as $file) {
                $file_path = $file->store('public/nota');
    
                $file_paths[] = $file_path;
            }
        }
        

        $data = Perbaikan::find($id);
        $data->status = 'selesai';
        $data->tanggal_selesai = $request->tanggal_selesai;
        $data->jumlah_pembayaran = $request->biaya;
        if (!empty($file_paths)) {
            $file_names = [];
            foreach ($file_paths as $file_path) {
                $file_names[] = pathinfo($file_path, PATHINFO_BASENAME);
            }
            $data->nota = implode(',', $file_names); // Menyimpan nama file terpisah oleh koma (,)
        }
    
        $data->save();

        // activity log
        $log = new ActivityLog();
        $log->login_time = session()->get('login_time', 'default');
        $log->user_id = Auth::user()->id;
        $log->user_level = 'super_admin';
        $log->action = 'update_perbaikan';
        $log->description = 'Update Perbaikan ke Sistem';
        $log->save();

        return redirect()->route('perbaikanSuper')->with('success', 'Perbaikan Berhasil Di Update');
    }
    public function deleteReportSuper($id){

        ReportForm::destroy($id);

        return redirect()->route('super_report')->with('delete', 'Report Berhasil Di Hapus');

    }
    public function deletePerbaikantSuper($id){

        $cekData = Perbaikan::where('id', $id)->first();
        if($cekData->nota){

            $nota = explode(',', $cekData->nota);

            foreach($nota as $n){
                Storage::delete('public/nota/' . trim($n));
            }
            
        }

        Perbaikan::destroy($id);

        $log = new ActivityLog();
        $log->login_time = session()->get('login_time', 'default');
        $log->user_id = Auth::user()->id;
        $log->user_level = 'super_admin';
        $log->action = 'hapus_perbaikan';
        $log->description = 'Hapus Data Perbaikan dari Sistem';
        $log->save();

        return redirect()->route('perbaikanSuper')->with('delete', 'Perbaikan Berhasil di Hapus');

    }
    


    // ADMIN
    public function reportForm(){
        
        $dataReport = ReportForm::all();

        return view('admin.adminReportForm', compact('dataReport'));
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

        return view('admin.adminDetailReport', compact('dataDocument', 'dataSafety', 'dataEngine', 'dataTools', 'pertanyaanTools', 'pertanyaanEngine', 'pertanyaanSafety', 'pertanyaanDocument', 'dataReport'));
    }
    public function inputPerbaikan($id){

        $dataReport = ReportForm::where('id', $id)->first();
        $dataBengkel = Bengkel::all();

        return  view('admin.adminInputPerbaikan', compact('dataReport', 'dataBengkel'));
    }
    public function storePerbaikan(Request $request, $id){

        $dataForm = ReportForm::where('id', $id)->first();

        $request->validate([
            'mitra' => 'required',
            'tanggal_perbaikan' => 'required',
            'no_polisi' => 'required',
        ],[
            'mitra.required' => 'Mitra Bengkel harus dipilih',
            'tanggal_perbaikan.required' => 'Tanggal Perbaikan harus diisi',
            'no_polisi.required' => 'No Polisi harus diisi',
        ]
        );

        $data = new Perbaikan();
        $data->id_report = $id;
        $data->no_polisi = $request->no_polisi;
        $data->nama_driver = $dataForm->nama_driver;
        $data->mitra_bengkel = $request->mitra;
        $data->tanggal_perbaikan = $request->tanggal_perbaikan;

        $data->save();
        $log = new ActivityLog();
        $log->login_time = session()->get('login_time', 'default');
        $log->user_id = Auth::user()->id;
        $log->user_level = 'admin';
        $log->action = 'input_perbaikan';
        $log->description = 'Input Perbaikan ke Sistem';
        $log->save();

        return redirect()->route('perbaikan')->with('success', 'Perbaikan berhasil disimpan');


    }
    public function perbaikan(){

        $dataPerbaikan = Perbaikan::all();

        return view('admin.adminPerbaikanForm', compact('dataPerbaikan'));
    }
    public function updatePerbaikan($id){

        $dataPerbaikan = Perbaikan::where('id', $id)->first();

        return view('admin.adminUpdatePerbaikan', compact('dataPerbaikan'));
    }
    public function storeUpdatePerbaikan(Request $request, $id){

        $request->validate([
            'tanggal_selesai' => 'required',
            'biaya' => 'required',
            'nota.*' => 'required|file|mimes:jpeg,jpg,png,pdf|max:10240'
        ],[
            'tanggal_selesai.required' => 'Tanggal Selesai tidak boleh Kosong',
            'biaya.required' => 'Biaya harus diisi',
            'nota.*.required' => 'Nota Harus di Upload',
            'nota.*.file' => 'File yang diunggah harus berupa file',
            'nota.*.mimes' => 'Format file harus berupa jpeg, jpg, png, atau pdf',
            'nota.*.max' => 'Ukuran file maksimal 10 MB',
        ]);

        
        $cekData = Perbaikan::where('id', $id)->first();
        if($cekData->nota){

            $nota = explode(',', $cekData->nota);

            foreach($nota as $n){
                Storage::delete('public/nota/' . trim($n));
            }
            
        }

        // untuk menyimpan kedalam folder upload 
        $file_paths = [];
        if ($request->hasFile('nota')) {
            foreach ($request->file('nota') as $file) {
                $file_path = $file->store('public/nota');
    
                $file_paths[] = $file_path;
            }
        }
        

        $data = Perbaikan::find($id);
        $data->status = 'selesai';
        $data->tanggal_selesai = $request->tanggal_selesai;
        $data->jumlah_pembayaran = $request->biaya;
        if (!empty($file_paths)) {
            $file_names = [];
            foreach ($file_paths as $file_path) {
                $file_names[] = pathinfo($file_path, PATHINFO_BASENAME);
            }
            $data->nota = implode(',', $file_names); // Menyimpan nama file terpisah oleh koma (,)
        }
    
        $data->save();

        // Activity Log
        $log = new ActivityLog();
        $log->login_time = session()->get('login_time', 'default');
        $log->user_id = Auth::user()->id;
        $log->user_level = 'admin';
        $log->action = 'update_perbaikan';
        $log->description = 'Update Perbaikan di Sistem';
        $log->save();

        return redirect()->route('perbaikan')->with('success', 'Perbaikan Berhasil Di Update');
    }
    public function tambahPerbaikan(){

        $dataReport = ReportForm::all();
        $dataMitra = Bengkel::all();

        return view('admin.adminTambahPerbaikan', compact('dataReport', 'dataMitra'));
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
    public function store(StoreAdminRequest $request)
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
        if (Admin::where('first_name', $validatedData['first_name'])->exists()) {
            return redirect()->back()->withErrors(['adminAda' => 'Admin telah ada']);
        }

        Admin::create($validatedData);


        $log = new ActivityLog();
        $log->login_time = session()->get('login_time', 'default');
        $log->user_id = Auth::user()->id;
        $log->user_level = 'super_admin';
        $log->action = 'input_admin';
        $log->description = 'Input Data Admin ke sistem';
        $log->save();
        
        return redirect('/super-admin/admin')->with('success', 'Akun Admin berhasil diBuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        return view('superAdmin.superAdminEditAdmin',[
            'data'=>$admin
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
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

        Admin::where('id', $admin->id)->update($validateData);

        $log = new ActivityLog();
        $log->login_time = session()->get('login_time', 'default');
        $log->user_id = Auth::user()->id;
        $log->user_level = 'super_admin';
        $log->action = 'update_admin';
        $log->description = 'Update Data Admin di Sistem';
        $log->save();

        return redirect('super-admin/admin')->with('successUpdate', 'Data Admin berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $admin=Admin::find($admin->id);
        $userAdmin = User::where('admin_id', $admin);
    
        if(!$userAdmin){
            Admin::destroy($admin->id);
        } else{
            if ($admin->user) {
                $admin->user->delete();
            }
            User::where('admin_id', $admin->id)->delete();
            Admin::where('id', $admin->id)->delete();
        }

        $log = new ActivityLog();
        $log->login_time = session()->get('login_time', 'default');
        $log->user_id = Auth::user()->id;
        $log->user_level = 'super_admin';
        $log->action = 'hapus_admin';
        $log->description = 'Hapus Data Admin dari Sistem';
        $log->save();

        return redirect('/super-admin/admin')->with('successDelete', 'Driver berhasil di hapus');
    }
}
