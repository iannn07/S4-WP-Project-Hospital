<?php

use App\Http\Controllers\API\AuthController as APIAuthController;
use App\Http\Controllers\API\DoctorController as APIDoctorController;
use App\Http\Controllers\API\ProfileController as APIProfileController;
use App\Http\Controllers\API\RoomController as APIRoomController;
use App\Http\Controllers\API\PatientController as APIPatientController;
use App\Http\Controllers\API\DiagnoseController as APIDiagnoseController;
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

Route::controller(APIAuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

// Protected Routes
Route::group(['middleware' => 'auth:api'], function () {

    Route::prefix('admin')->middleware(['role:Admin'])->group(function () {
        // Account Management
        Route::get('profile', [APIProfileController::class, 'index']);
        Route::put('profile-update/{id}', [APIProfileController::class, 'update']);

        // Room Data Management
        Route::get('room-data', [APIRoomController::class, 'index']);
        Route::get('room-details/{id}', [APIRoomController::class, 'show']);
        Route::post('room-new', [APIRoomController::class, 'store']);
        Route::put('room-update/{id}', [APIRoomController::class, 'update']);
        Route::delete('room-delete/{id}', [APIRoomController::class, 'destroy']);

        // Patient Data Management
        Route::get('patient-data', [APIPatientController::class, 'index']);
        Route::get('patient-details/{id}', [APIPatientController::class, 'show']);
        Route::post('patient-new', [APIPatientController::class, 'store']);
        Route::put('patient-update/{id}', [APIPatientController::class, 'update']);
        Route::delete('patient-delete/{id}', [APIPatientController::class, 'destroy']);
    });

    Route::prefix('doctor')->middleware(['role:Doctor'])->group(function () {
        // Account Management
        Route::get('profile', [APIProfileController::class, 'index']);
        Route::put('profile-update/{id}', [APIProfileController::class, 'update']);

        // Doctor Data Management
        Route::get('doctor-data', [APIDoctorController::class, 'index']);
        Route::get('doctor-details/{id}', [APIDoctorController::class, 'show']);
        Route::post('doctor-new', [APIDoctorController::class, 'store']);
        Route::put('doctor-update/{id}', [APIDoctorController::class, 'update']);
        Route::delete('doctor-delete/{id}', [APIDoctorController::class, 'destroy']);

        // Diagnose Data Management
        Route::get('diagnose-data', [APIDiagnoseController::class, 'index']);
        Route::get('diagnose-details/{id}', [APIDiagnoseController::class, 'show']);
        Route::put('diagnose-update/{id}', [APIDiagnoseController::class, 'update']);
    });
});
