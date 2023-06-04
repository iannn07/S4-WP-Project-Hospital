<?php

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

Route::group(['prefix' => 'admin'], function () {
    Route::redirect('/', '/admin/login');
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', function () {
            return view('auth.login');
        });
    });
});

Route::group(['prefix' => '/admin', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', [WebController::class, 'admin'])->name('admin.dashboard');
    Route::get('/profile', [WebController::class, 'profile'])->name('admin.profile');
});
