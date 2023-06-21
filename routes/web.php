<?php

use App\Http\Controllers\DataCounter;
use App\Http\Controllers\ProfileController;
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
    Route::get('/dashboard', [WebController::class, 'admin_dashboard'])->name('admin.dashboard');
    Route::get('/profile', [WebController::class, 'profile'])->name('admin.profile');
    Route::get('/faq', [WebController::class, 'faq'])->name('admin.faq');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::get('/doctorTable', [WebController::class, 'admin_doctor_data'])->name('admin.doctor.table');
    Route::get('/patientData/view', [WebController::class, 'admin_patient_view'])->name('admin.patient.view');
    Route::get('/patientData/organize', [WebController::class, 'admin_patient_crud'])->name('admin.patient.crud');
    Route::get('/echarts', [DataCounter::class, 'echart']);
});

Route::group(['prefix' => '/doctor', 'middleware' => ['auth', 'role:Doctor']], function () {
    Route::get('/dashboard', [WebController::class, 'doctor_dashboard'])->name('doctor.dashboard');
    Route::get('/profile', [WebController::class, 'profile'])->name('doctor.profile');
    Route::get('/faq', [WebController::class, 'faq'])->name('doctor.faq');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('doctor.profile.update');
    Route::get('/doctorTable', [WebController::class, 'doctor_table_data'])->name('doctor.doctor.table');
    Route::get('/echarts', [DataCounter::class, 'echart']);
});
