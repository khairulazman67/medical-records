<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->middleware(['auth'])->name('beranda');
    Route::get('/datapasien', [AdminController::class, 'datapasien']);
    Route::post('/tambahdatapasien',[AdminController::class,'tambahdatapasien']);
    Route::delete('/pasien/{NIK}',[AdminController::class,'hapusdatapasien']);
    Route::get('/pasien/{NIK}',[AdminController::class,'editdatapasien']);
    Route::post('/editpasien',[AdminController::class,'proseditdatapasien']);
    Route::post('/simpanrekammedis',[AdminController::class,'simpanrekammedis']);
    
    Route::post('/editrekammedis',[AdminController::class,'editrekammedis']);

    Route::get('/caripasien',function(){
        return view('caripasien');
    });
    Route::post('/caripasien',[AdminController::class,'caripasien']);
});
require __DIR__.'/auth.php';
