<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BengkelController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuperDriverController;
use App\Http\Controllers\SuperUserController;
use App\Http\Controllers\SuperUnitController;
use App\Http\Controllers\SuperBengkelController;
use App\Http\Controllers\TCPDFController;
use App\Models\Driver;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function(){return view('welcome');});
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'autentikasiLogin']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Route Super Admin
Route::middleware(['auth', 'userRole:super_admin'])->group(function(){
    Route::prefix('super-admin')->group(function(){
        Route::get('/', [DashboardController::class, 'dashboardSuperAdmin']);
        Route::resource('admin', AdminController::class);
        Route::resource('driver', SuperDriverController::class);
        Route::resource('unit', SuperUnitController::class);
        Route::resource('bengkel', SuperBengkelController::class);
        Route::prefix('inputUser')->group(function(){
            Route::get('driver', [SuperUserController::class, 'inputAkunDriver']);
            Route::post('driver', [SuperUserController::class, 'storeAkunDriver']);
            Route::get('admin', [SuperUserController::class, 'inputAkunAdmin']);
            Route::post('admin', [SuperUserController::class, 'storeAkunAdmin']);
    
        });
        Route::post('filter-report-super', [AdminController::class, 'filterReportSuper']);
        Route::post('filter-perbaikan-super', [AdminController::class, 'filterPerbaikanSuper']);
        Route::post('filter-perbaikan-selesai-super', [AdminController::class, 'filterPerbaikanSelesaiSuper']);
        Route::get('inputAdmin', function(){return view('superAdmin.superAdminInputAdmin');});
        Route::get('inputDriver', function(){return view('superAdmin.adminInputDriver');});
        Route::get('inputUnit', function(){return view('superAdmin.adminInputUnit');});
        Route::get('inputBengkel', function(){return view('superAdmin.adminInputBengkel');});
        Route::get('reportForm', [AdminController::class, 'superReportForm'])->name('super_report');
        Route::get('perbaikan', [AdminController::class, 'superPerbaikan'])->name('perbaikanSuper');
        Route::get('detailReport/{id}', [AdminController::class, 'superDetailReport']);
        Route::get('inputPerbaikan/{id}', [AdminController::class, 'inputPerbaikanSuper']);
        Route::post('inputPerbaikan/{id}', [AdminController::class, 'storePerbaikanSuper']);
        Route::get('updatePerbaikan/{id}', [AdminController::class, 'updatePerbaikanSuper']);
        Route::post('updatePerbaikan/{id}', [AdminController::class, 'storeUpdatePerbaikanSuper']);
        Route::get('deleteReportSuper/{id}', [AdminController::class, 'deleteReportSuper']);
        Route::get('deletePerbaikanSuper/{id}', [AdminController::class, 'deletePerbaikantSuper']);

        Route::prefix('pdf')->group(function(){
            Route::get('reportPDF/{id}', [TCPDFController::class, 'reportFormAdmin']);;
        });
    });
});

// Route Admin
Route::middleware(['auth', 'userRole:admin'])->group(function(){
    Route::prefix('admin')->group(function(){
        Route::get('/', [DashboardController::class, 'dashboardAdmin']);
        Route::resource('driver', DriverController::class);
        Route::resource('unit', UnitController::class);
        Route::resource('bengkel', BengkelController::class);
        Route::prefix('inputUser')->group(function(){
            Route::get('driver', [UserController::class, 'inputAkunDriver']);
            Route::post('driver', [UserController::class, 'storeAkunDriver']);
        });
        Route::post('filter-report-admins', [AdminController::class, 'filterReportAdmin']);
        Route::post('filter-report-perbaikan-admin', [AdminController::class, 'filterPerbaikanSuper']);
        Route::post('filter-report-admin', [AdminController::class, 'filterPerbaikanSelesaiAdmin']);
        Route::get('inputDriver', function(){return view('admin.adminInputDriver');});
        Route::get('inputUnit', function(){return view('admin.adminInputUnit');});
        Route::get('inputBengkel', function(){return view('admin.adminInputBengkel');});
        Route::get('reportForm', [AdminController::class, 'reportForm']);
        Route::get('perbaikan', [AdminController::class, 'perbaikan'])->name('perbaikan');
        Route::get('inputPerbaikan/{id}', [AdminController::class, 'inputPerbaikan']);
        Route::post('inputPerbaikan/{id}', [AdminController::class, 'storePerbaikan']);
        Route::get('detailReport/{id}', [AdminController::class, 'detailReport'])->name('detailReportAdmin');
        Route::get('updatePerbaikan/{id}', [AdminController::class, 'updatePerbaikan']);
        Route::post('updatePerbaikan/{id}', [AdminController::class, 'storeUpdatePerbaikan']);
        Route::get('tambahPerbaikan', [AdminController::class, 'tambahPerbaikan']);

        Route::prefix('pdf')->group(function(){
            Route::get('reportPDF/{id}', [TCPDFController::class, 'reportFormAdmin']);;

        });
    });
});

// Route Driver
Route::middleware(['auth', 'userRole:driver', 'web'])->group(function(){
    Route::prefix('driver')->group(function(){
        Route::get('/',[DashboardController::class, 'dashboardDriver']);
        Route::prefix('form')->group(function(){
            Route::get('document', [FormController::class, 'formDocument'])->name('formDocument');
            Route::get('safety', [FormController::class, 'formSafety'])->name('formSafety');
            Route::get('engine', [FormController::class, 'formEngine'])->name('formEngine');
            Route::get('tools', [FormController::class, 'formTools'])->name('formTools');
            Route::get('preview', [FormController::class, 'preview'])->name('Preview')->middleware('cekForm');
            Route::post('document', [FormController::class, 'storeDocument']);
            Route::post('safety', [FormController::class, 'storeSafety']);
            Route::post('engine', [FormController::class, 'storeEngine']);
            Route::post('tools', [FormController::class, 'storeTools']);
            Route::get('storeDatabase', [FormController::class, 'storeDatabase']);
        });
        Route::get('report', [DriverController::class, 'report'])->name('driverReport');

        Route::post('filter-report-driver', [DriverController::class, 'filterReport']);

        Route::get('detailReport/{id}', [DriverController::class, 'detailReport'])->name('detailReport');
    });
});

