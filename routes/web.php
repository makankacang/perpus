<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerpusController;
use App\Http\Middleware\CheckLevel;

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', [PerpusController::class, 'index'])->name('home');
    Route::get('/logout', [PerpusController::class, 'logout'])->name('logout');
    Route::post('/store', [PerpusController::class, 'store'])->name('borrow.store'); 
   


    Route::get('/buku',  [PerpusController::class, 'buku'])->name('admin.buku');
    Route::post('/bukuedit/{BukuID}', [PerpusController::class, 'bookedit'])->name('bukuedit');
    Route::post('/bukuinput', [PerpusController::class, 'bookinput'])->name('bukuinput'); 
    Route::get('/deletebuku/{BukuID}', [PerpusController::class, 'deletebuku'])->name('deletebuku'); 


    Route::get('/kategori',  [PerpusController::class, 'katbuku'])->name('admin.kategori');
    Route::post('/katbukuedit/{katBukuID}', [PerpusController::class, 'katbukuedit'])->name('katbukuedit');
    Route::post('/katbukuinput', [PerpusController::class, 'katbukuinput'])->name('katbukuinput'); 
    Route::get('/katbukudelete/{katBukuID}', [PerpusController::class, 'deletekatbuku'])->name('deletekatbuku'); 


    Route::get('/koleksis',  [PerpusController::class, 'koleksi'])->name('admin.koleksi');
    Route::get('/koleksidelete/{katBukuID}', [PerpusController::class, 'koleksidelete'])->name('koleksidelete'); 

    Route::get('/peminjaman',  [PerpusController::class, 'peminjaman'])->name('admin.pinjaman');
    Route::post('/konfirmasi-peminjaman/{id}', [PerpusController::class, 'konfirmasiPeminjaman'])->name('konfirmasiPeminjaman');

    Route::get('/home', [PerpusController::class, 'indexp'])->name('homep');
    Route::get('/perpustakaan', [PerpusController::class, 'perpustakaan'])->name('peminjam.perpus');
    Route::get('/peminjamansaya',  [PerpusController::class, 'peminjamansaya'])->name('peminjam.pinjaman');
    Route::get('/koleksi',  [PerpusController::class, 'koleksip'])->name('peminjam.koleksi');
    Route::post('/kembalikan-buku/{id}', [PerpusController::class, 'kembalikanBuku'])->name('kembalikanBuku');
    Route::post('/add-to-collection', [PerpusController::class, 'addToCollection'])->name('add-to-collection');

});
