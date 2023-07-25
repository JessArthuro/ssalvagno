<?php

use App\Http\Controllers\CotizacionesController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\EmbarcacionesController;
use App\Http\Controllers\AlimentosController;
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

Route::get('/', function () {
    return view('layouts.master');
});

Route::resource('quotes', CotizacionesController::class);
Route::get('quotes/pdf/{quote}', [CotizacionesController::class, 'pdf'])->name('generate_pdf');
Route::resource('services', ServiciosController::class);
Route::resource('companies', EmpresasController::class)->except(['show']);
Route::resource('boats', EmbarcacionesController::class)->except(['show']);
Route::resource('foods', AlimentosController::class)->except(['show']);
