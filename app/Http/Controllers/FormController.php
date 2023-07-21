<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\FormDocument;
use App\Models\FormEngine;
use App\Models\FormSafety;
use App\Models\FormTools;
use App\Models\Pertanyaan;
use App\Models\ReportForm;
use App\Models\Unit;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Node\Block\Document;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function formDocument(){
        $pertanyaan = Pertanyaan::where('kategori', 'document')->get();
        $dataUnit = Unit::all();

        return view('driver.formDocument', compact('pertanyaan', 'dataUnit'));
    }
    public function formSafety(){
        $pertanyaan = Pertanyaan::where('kategori', 'safety')->get();

        return view('driver.formSafety', compact('pertanyaan'));
    }
    public function formEngine(){
        $pertanyaan = Pertanyaan::where('kategori', 'engine')->get();

        return view('driver.formEngine', compact('pertanyaan'));
    }
    public function formTools(){
        $pertanyaan = Pertanyaan::where('kategori', 'tools')->get();

        return view('driver.formTools', compact('pertanyaan'));
    }
    public function preview(){
        $pertanyaanDocument  = Pertanyaan::where('kategori', 'document')->get();
        $pertanyaanSafety  = Pertanyaan::where('kategori', 'safety')->get();
        $pertanyaanEngine  = Pertanyaan::where('kategori', 'engine')->get();
        $pertanyaanTools  = Pertanyaan::where('kategori', 'tools')->get();
        $documentData = session('document');
        $safetyeData = session('safety');
        $engineData = session('engine');
        $toolsData = session('tools');

        return view('driver.formPreview', compact('documentData','safetyeData', 'engineData', 'toolsData', 'pertanyaanDocument', 'pertanyaanSafety', 'pertanyaanEngine', 'pertanyaanTools'));
    }

    public function storeDocument(Request $request){

        $validateData = $request->validate([
            'shift' => 'required',
            'tanggal_pemeriksan' => 'required',
            'no_unit' => 'required',
            'fuel' => 'required',
            'km_awal' => 'required',
            'jawaban_*' => 'required',
        ],[
            'shift.required' => 'Shift tidak boleh kosong',
            'tanggal_pemeriksan.required' => 'Tanggal Pemeriksaan tidak boleh kosong',
            'no_unit.required' => 'Unit tidak boleh kosong',
            'fuel.required' => 'Fuel tidak boleh kosong',
            'jawaban_*.required' => 'Jawaban tidak boleh kosong',
        ]
        );

        $request->session()->put('document', $request->all());

        return redirect()->route('formSafety');

    }
    public function storeSafety(Request $request){
        $request->validate([
            'jawaban_*' => 'required',
        ]);

        $request->session()->put('safety', $request->all());

        return redirect()->route('formEngine');
    }
    public function storeEngine(Request $request){
        $request->validate([
            'jawaban_*' => 'required',
        ]);

        $request->session()->put('engine', $request->all());

        return redirect()->route('formTools');
    }
    public function storeTools(Request $request){
        $request->validate([
            'jawaban_*' => 'required',
        ]);

        $request->session()->put('tools', $request->all());

        return redirect()->route('Preview');
    }
    public function storeDatabase(Request $request){

        $user_id = Auth::user();

        $pertanyaanDocument = Pertanyaan::where('kategori', 'document')->get();
        $pertanyaanSafety = Pertanyaan::where('kategori', 'safety')->get();
        $pertanyaanEngine = Pertanyaan::where('kategori', 'engine')->get();
        $pertanyaanTools = Pertanyaan::where('kategori', 'tools')->get();
        
        $dataDocument = session('document');
        $dataSafety = session('safety');
        $dataEngine = session('engine');
        $dataTools = session('tools');

        // save Data Document ke DataBase
        $document = new FormDocument();
        $document->user_id = $user_id->id;
        $document->shift = $dataDocument['shift'];
        $document->tgl_pemeriksaan = $dataDocument['tanggal_pemeriksan'];
        $document->no_polisi = $dataDocument['no_unit'];
        $document->fuel = $dataDocument['fuel'];
        $document->km_awal = $dataDocument['km_awal'];
        foreach($pertanyaanDocument as $doc){
            $jawaban = $dataDocument['jawaban_'.$doc->id];
            $keterangan = $dataDocument['keterangan_'.$doc->id];

            $document->{ 'pertanyaan_'.$doc->id } = $jawaban;
            $document->{ 'keterangan_'.$doc->id } = $keterangan;
        }
        $document->save();

        // save Data Safety ke DataBase
        $safety = new FormSafety();
        $safety->user_id = $user_id->id;
        $safety->shift = $dataDocument['shift'];
        $safety->tgl_pemeriksaan = $dataDocument['tanggal_pemeriksan'];
        $safety->no_polisi = $dataDocument['no_unit'];
        foreach($pertanyaanSafety as $safe){
            $jawaban = $dataSafety['jawaban_'.$safe->id];
            $keterangan = $dataSafety['keterangan_'.$safe->id];

            $safety->{ 'pertanyaan_'.$safe->id } = $jawaban;
            $safety->{ 'keterangan_'.$safe->id } = $keterangan;
        }
        $safety->save();

        // save Data Engine ke DataBase
        $engine = new FormEngine();
        $engine->user_id = $user_id->id;
        $engine->shift = $dataDocument['shift'];
        $engine->tgl_pemeriksaan = $dataDocument['tanggal_pemeriksan'];
        $engine->no_polisi = $dataDocument['no_unit'];
        foreach($pertanyaanEngine as $eng){
            $jawaban = $dataEngine['jawaban_'.$eng->id];
            $keterangan = $dataEngine['keterangan_'.$eng->id];

            $engine->{ 'pertanyaan_'.$eng->id } = $jawaban;
            $engine->{ 'keterangan_'.$eng->id } = $keterangan;
        }
        $engine->save();

        // save Data Engine ke DataBase
        $tools = new FormTools();
        $tools->user_id = $user_id->id;
        $tools->shift = $dataDocument['shift'];
        $tools->tgl_pemeriksaan = $dataDocument['tanggal_pemeriksan'];
        $tools->no_polisi = $dataDocument['no_unit'];
        foreach($pertanyaanTools as $tool){
            $jawaban = $dataTools['jawaban_'.$tool->id];
            $keterangan = $dataTools['keterangan_'.$tool->id];

            $tools->{ 'pertanyaan_'.$tool->id } = $jawaban;
            $tools->{ 'keterangan_'.$tool->id } = $keterangan;
        }
        $tools->save();

        // input ke Database Report
        $report = new ReportForm();
        $report->id_driver = $user_id->id;
        $report->nama_driver = $user_id->driver->first_name.' '.$user_id->driver->last_name;
        $report->shift = $dataDocument['shift'];
        $report->no_polisi = $dataDocument['no_unit'];
        $report->tanggal_input = $dataDocument['tanggal_pemeriksan'];
        $report->save();

        
        $request->session()->forget('document');
        $request->session()->forget('safety');
        $request->session()->forget('engine');
        $request->session()->forget('tools');

        $log = new ActivityLog();
        $log->login_time = session()->get('login_time', 'default');
        $log->user_id = Auth::user()->id;
        $log->user_level = 'driver';
        $log->action = 'input_form';
        $log->description = 'Input Data Form ke Sistem';
        $log->save();
        
        return redirect()->route('driverReport')->with('success', 'Data Berhasil diSimpan');
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
    public function show(Pertanyaan $pertanyaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pertanyaan $pertanyaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pertanyaan $pertanyaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pertanyaan $pertanyaan)
    {
        //
    }
}
