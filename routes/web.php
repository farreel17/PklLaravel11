<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    return view('welcome');
});
//pegawai
Route::get('/pegawai',[EmployeeController::class, 'index'])->name('pegawai');
//tambah pegaai
Route::get('/tambahpegawai',[EmployeeController::class, 'tambahpegawai'])->name('tambahpegawai');
Route::post('/insertdata',[EmployeeController::class, 'insertdata'])->name('insertdata');
//edit pegawai
Route::get('/tambahdata/{id}',[EmployeeController::class, 'tambahdata'])->name('tambahdata');
Route::post('/updatedata/{id}',[EmployeeController::class, 'updatedata'])->name('updatedata');
//Delete Pegawai
Route::get('/delete/{id}',[EmployeeController::class, 'delete'])->name('delete');
