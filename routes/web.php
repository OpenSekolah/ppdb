<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


use App\Http\Controllers\{
    Home\WelcomeController,
    Home\RegisterController,
    Home\DashboardController,
    Home\RegisterPdfController,
    Home\UserDataController,
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', WelcomeController::class)->name('home.welcome');
Route::post('register_form', [RegisterController::class, 'store'])->name('register_form.store');
Route::get('register_form/{user}', [RegisterController::class, 'show'])->name('register_form.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/register/pdf/{user}', RegisterPdfController::class)->name('register.pdf');

    Route::get('/userdata', [UserDataController::class, 'create'])->name('userdata.create');
    Route::post('/userdata', [UserDataController::class, 'store'])->name('userdata.store');
});
