<?php
namespace App\Http\Controllers\frontoffice;

use App\Http\Controllers\backoffice\BookingController;
use Illuminate\Support\Facades\Route;

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
// \Artisan::call('cache:clear');
// \Artisan::call('route:clear');

Route::get('/config/clear', function() {
    \Artisan::call('cache:clear');
    \Artisan::call('config:clear');
    \Artisan::call('route:clear');
    return response([
        'message' => 'ok'
    ]);
});

Route::get('/', [HomeController::class, 'index']);
Route::prefix('{language}')->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/home', [HomeController::class, 'mainContent'])->name('home');
    Route::get('/menu', [HomeController::class, 'contentMore']);
    Route::get('/catering', [HomeController::class, 'contentMore']);
    Route::get('/gallery', [HomeController::class, 'contentMore']);
    Route::get('/delivery', [HomeController::class, 'contentSingle']);
    Route::get('/aboutus', [HomeController::class, 'contentSingle']);
    Route::get('/ourlocation', [HomeController::class, 'contentSingle']);
    Route::get('/contactus', [HomeController::class, 'contentSingle']);
    Route::get('/book', [HomeController::class, 'contentSingle']);
});

Route::post('/api/booking', [HomeController::class, 'booking']);
Route::post('/api/sendContact', [HomeController::class, 'sendContact']);
