<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataCounter;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

// Protected Routes
Route::group(['middleware' => 'auth:api'], function () {

    // Admin Routes
    Route::prefix('admin')->middleware(['role:Admin'])->group(function () {
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

    // Doctor Routes
    Route::prefix('doctor')->middleware(['role:Doctor'])->group(function () {
        // Hospital Account Management
        Route::get('/dashboard', [WebController::class, 'doctor_dashboard'])->name('doctor.dashboard');
        Route::get('/profile', [WebController::class, 'profile'])->name('doctor.profile');
        Route::put('/profile/update', [ProfileController::class, 'update'])->name('doctor.profile.update');
        Route::get('/faq', [WebController::class, 'faq'])->name('doctor.faq');

        // Hospital Doctor Management
        Route::get('/doctorTable', [WebController::class, 'doctor_table_data'])->name('doctor.doctor.table');
        Route::resource('/doctorController', DoctorController::class);

        // Hospital Diagnosis Management
        Route::get('/diagnosis', [WebController::class, 'doctor_diagnosis'])->name('doctor.doctor.diagnosis');
        Route::resource('/diagnosisController', DiagnosisController::class);

        // Hospital Diagnose Management
        Route::get('/echarts', [DataCounter::class, 'echart']);
    });

});
