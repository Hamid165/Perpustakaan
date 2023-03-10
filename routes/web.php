<?php

use App\Models\Buku;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BpController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CetakLaporanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\RiwayatPinjamController;

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
    $iduser = Auth::id();
    $profile = Profile::where('users_id', $iduser)->first();
    return view('test', [
        "buku"=>Buku::paginate(6), 'profile' => $profile
    ]);
});
Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [App\Http\Controllers\BukuController::class, 'index']);

    Route::resource('kategori', KategoriController::class);

    Route::resource('buku', BukuController::class);

    Route::resource('anggota', AnggotaController::class);

    Route::resource('profile', ProfileController::class)->only('index','update','edit');

    Route::resource('peminjaman', RiwayatPinjamController::class);

    Route::get('/cetaklaporan', CetakLaporanController::class);

    Route::get('/pengembalian', [PengembalianController::class,'index']);

    Route::post('/pengembalian', [PengembalianController::class,'pengembalian']);

});
