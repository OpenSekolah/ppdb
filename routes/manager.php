<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

use App\Http\Controllers\Managers\{
    Home\DashboardController,
    Ppdb\AdmissionController,
    Ppdb\PpdbDataController,
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

Route::name('manager.')->group(function () {
    $limiter = config('fortify.limiters.login');

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
            ->middleware(['guest:manager'])
            ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware(array_filter([
            'guest:manager',
            $limiter ? 'throttle:' . $limiter : null,
    ]))->name('login');


    
    //Logout the user
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

Route::middleware([
    'auth:manager',
    'verified',
])->group(function () {
    Route::get('/', DashboardController::class)->name('manager.dashboard');

    Route::group(['prefix' => 'ppdb'], function () {
        Route::resource('admissions', AdmissionController::class, [
            'as' => 'manager.ppdb',
            'only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']
        ]);

        Route::resource('ppdbdatas', PpdbDataController::class, [
            'as' => 'manager.ppdb',
            'only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']
        ]);
    });
});
