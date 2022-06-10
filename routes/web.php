<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SasaranKerjaPegawaiController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pegawai', function () {
    return view('dashboard');
})->middleware(['auth'])->name('pegawai.index');

require __DIR__.'/auth.php';

// Route::get('/dashboard', [App\Http\Controllers\SasaranKerjaPegawaiController::class, 'Index'])->name('dashboard');
// Route::get('/create', [App\Http\Controllers\SasaranKerjaPegawaiController::class, 'create'])->name('create');
// Route::post('/create', [App\Http\Controllers\SasaranKerjaPegawaiController::class, 'store'])->name('store');

/**
 * pegawai.index
 * pegawai.create
 * pegawai.store
 * pegawai.show
 * pegawai.edit
 * pegawai.destroy
 * pegawai.update
 */
Route::resource('pegawai', SasaranKerjaPegawaiController::class)
    ->missing(function(Request $request) {
        return redirect::route('pegawai.index');
    });
