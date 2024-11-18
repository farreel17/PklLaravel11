<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\CheckRole;
use App\Models\Employee;

Route::get('/', function () {
    $jumlahpegawai = Employee::count();
    $jumlahpegawailaki = Employee::where('jeniskelamin','Laki-laki')->count();
    $jumlahpegawaiperempuan = Employee::where('jeniskelamin','Perempuan')->count();

    return view('welcome', compact('jumlahpegawai','jumlahpegawailaki','jumlahpegawaiperempuan'));
});

//pegawai
//Route::get('/pegawai',[EmployeeController::class, 'index'])->name('pegawai');

//tambah pegaai
Route::get('/tambahpegawai',[EmployeeController::class, 'tambahpegawai'])->name('tambahpegawai');
Route::post('/insertdata',[EmployeeController::class, 'insertdata'])->name('insertdata');

//edit pegawai
Route::get('/tambahdata/{id}',[EmployeeController::class, 'tambahdata'])->name('tambahdata');
Route::post('/updatedata/{id}',[EmployeeController::class, 'updatedata'])->name('updatedata');

//Delete Pegawai
Route::get('/delete/{id}',[EmployeeController::class, 'delete'])->name('delete');

//logi
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/loginproses', [LoginController::class, 'loginproses'])->name('loginproses');

//register
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/registeruser', [LoginController::class, 'registeruser'])->name('registeruser');

//logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// view pegawai
//Route::get('/viewpegawai',[EmployeeController::class, 'viewpegawai'])->name('viewpegawai');


//HakAkses
Route::group(['middleware' => ['auth', 'hak_akses:superadmin,admin']], function(){
    Route::get('/pegawai',[EmployeeController::class, 'index'])->name('pegawai');

});
Route::group(['middleware' => ['auth', 'hak_akses:superadmin,user']], function(){
    Route::get('/viewpegawai',[EmployeeController::class, 'viewpegawai'])->name('viewpegawai');
});