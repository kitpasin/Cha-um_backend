<?php
namespace App\Http\Controllers\frontoffice;

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

Route::get('/', function () {
    return "Chaum2021_API";
});

