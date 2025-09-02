<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Admin\InformasiController;
use App\Http\Controllers\Admin\VisiMisiController;
use App\Http\Controllers\Admin\StrukturOrganisasiController;
use App\Http\Controllers\Admin\JamOperasionalController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\InovasiController;

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

//Clear All:
Route::get('/clear', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('optimize');
    $exitCode = Artisan::call('route:cache');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('config:cache');
    return '<h1>Berhasil dibersihkan</h1>';
});

Route::get('/', function () {
    return view('welcome');
});

// Authentication
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/keluar', [HomeController::class, 'keluar']);
Route::get('/admin/home', [HomeController::class, 'index']);
Route::get('/admin/change', [HomeController::class, 'change']);
Route::post('/admin/change_password', [HomeController::class, 'change_password']);

// Kategori
Route::prefix('admin/kategori')
    ->name('admin.kategori.')
    ->middleware('cekLevel:1 2')
    ->controller(KategoriController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/add', 'add')->name('add');
        Route::post('/create', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });
    
// Account
Route::prefix('admin/account')
    ->name('admin.account.')
    ->middleware('cekLevel:1')
    ->controller(AccountController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/add', 'add')->name('add');
        Route::post('/create', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
        Route::get('/reset/{id}', 'reset')->name('reset'); // Hanya untuk Account
    });

// Banner
Route::prefix('admin/banner')
    ->name('admin.banner.')
    ->middleware('cekLevel:1 2')
    ->controller(BannerController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/add', 'add')->name('add');
        Route::post('/create', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });

// Pegawai
Route::prefix('admin/pegawai')
    ->name('admin.pegawai.')
    ->middleware('cekLevel:1 2')
    ->controller(PegawaiController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/add', 'add')->name('add');
        Route::post('/create', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });

// Informasi
Route::prefix('admin/informasi')
    ->name('admin.informasi.')
    ->middleware('cekLevel:1 2')
    ->controller(InformasiController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/add', 'add')->name('add');
        Route::post('/create', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });

// Visi Misi
Route::prefix('admin/visi_misi')
    ->name('admin.visi_misi.')
    ->middleware('cekLevel:1 2')
    ->controller(VisiMisiController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/add', 'add')->name('add');
        Route::post('/create', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });

// Struktur Organisasi
Route::prefix('admin/struktur')
    ->name('admin.struktur.')
    ->middleware('cekLevel:1 2')
    ->controller(StrukturOrganisasiController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/add', 'add')->name('add');
        Route::post('/create', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });

// Jam Operasional
Route::prefix('admin/jam_operasional')
    ->name('admin.jam_operasional.')
    ->middleware('cekLevel:1 2')
    ->controller(JamOperasionalController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/add', 'add')->name('add');
        Route::post('/create', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });

// Layanan
Route::prefix('admin/layanan')
    ->name('admin.layanan.')
    ->middleware('cekLevel:1 2')
    ->controller(LayananController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/add', 'add')->name('add');
        Route::post('/create', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });

// Inovasi
Route::prefix('admin/inovasi')
    ->name('admin.inovasi.')
    ->middleware('cekLevel:1 2')
    ->controller(InovasiController::class)
    ->group(function () {
        Route::get('/', 'read')->name('read');
        Route::get('/add', 'add')->name('add');
        Route::post('/create', 'create')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });