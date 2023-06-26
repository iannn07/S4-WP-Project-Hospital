<?php

use App\Http\Controllers\DataCounter;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;

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

// Route::get('/', function () {
//     return redirect('/home');
// });

// Route::group(['prefix' => 'home'], function () {
//     Route::get('/', function () {
//         return view('home');
//     })->name('home');
// });

Auth::routes(['register' => false]);

Route::group(['prefix' => 'employee'], function () {
    Route::redirect('/', '/employee/login');
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', function () {
            return view('auth.login');
        });
    });
});

Route::group(['prefix' => '/admin', 'middleware' => ['auth', 'role:Admin']], function () {
    // Hospital Account Management
    Route::get('/dashboard', [WebController::class, 'admin_dashboard'])->name('admin.dashboard');
    Route::get('/profile', [WebController::class, 'profile'])->name('admin.profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::get('/faq', [WebController::class, 'faq'])->name('admin.faq');


    // Hospital Data Management - Doctor
    Route::get('/doctorTable', [WebController::class, 'admin_doctor_data'])->name('admin.doctor.table');

    // Hospital Data Management - Patient
    Route::resource('/patientController', PatientController::class);
    Route::delete('/patientData/truncate', [DataCounter::class, 'truncate'])->name('admin.patient.truncate');
    Route::get('/patientData/view', [WebController::class, 'admin_patient_view'])->name('admin.patient.view');
    Route::get('/patientData/organize', [WebController::class, 'admin_patient_crud'])->name('admin.patient.crud');

    // Hospital Data Management - Room
    Route::resource('/roomController', RoomController::class);
    Route::get('/roomData/view', [WebController::class, 'admin_room_view'])->name('admin.room.view');
    Route::get('/roomData/organize', [WebController::class, 'admin_room_crud'])->name('admin.room.crud');
    Route::get('/echarts', [DataCounter::class, 'echart']);
});

Route::group(['prefix' => '/doctor', 'middleware' => ['auth', 'role:Doctor']], function () {
    // Hospital Account Management
    Route::get('/dashboard', [WebController::class, 'doctor_dashboard'])->name('doctor.dashboard');
    Route::get('/profile', [WebController::class, 'profile'])->name('doctor.profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('doctor.profile.update');
    Route::get('/faq', [WebController::class, 'faq'])->name('doctor.faq');
    Route::get('/doctorTable', [WebController::class, 'doctor_table_data'])->name('doctor.doctor.table');

    // Hospital Doctor Management
    Route::resource('/doctorController', DoctorController::class);

    // Hospital Diagnose Management
    Route::get('/echarts', [DataCounter::class, 'echart']);
});
