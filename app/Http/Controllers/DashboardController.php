<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Unit;
use App\Models\Bengkel;
use App\Models\Perbaikan;
use App\Models\ReportForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function dashboardAdmin(){
        $dataUser = Auth::user();
        $dataDriver = Driver::all();
        $dataUnit = Unit::all();
        $dataBengkel = Bengkel::all();
        $dataReport = ReportForm::all();
        $dataPerbaikan = Perbaikan::all();


        return view('admin.adminDashboard', compact('dataDriver', 'dataUnit', 'dataBengkel', 'dataUser', 'dataReport', 'dataPerbaikan'));
    }

    public function dashboardSuperAdmin(){
        $dataUser = Auth::user();
        $dataDriver = Driver::all();
        $dataUnit = Unit::all();
        $dataBengkel = Bengkel::all();
        $dataReport = ReportForm::all();
        $dataPerbaikan = Perbaikan::all();

        return view('superAdmin.superAdminDashboard', compact('dataDriver', 'dataUnit', 'dataBengkel', 'dataUser', 'dataReport', 'dataPerbaikan'));
    }

    public function dashboardDriver(){

        return view('driver.driverDashboard');
    }
}
