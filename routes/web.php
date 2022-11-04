<?php

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
Auth::routes();
Route::get('/', function () {
    return redirect('/home');
});
/*
Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/barcode', [App\Http\Controllers\barcodecontroller::class, 'barcode']);

Route::get('/postproducto/{cantidad}/{producto}', [App\Http\Controllers\inventarioController::class, 'postproducto']);

Route::get('/zonapistola', [App\Http\Controllers\HomeController::class, 'pistolear']);

Route::get('/agregarproducto', [App\Http\Controllers\HomeController::class, 'producto']);

Route::post('/pistolear/{id}', [App\Http\Controllers\inventarioController::class, 'pistolear']);

Route::get('/getpistolear/{id}', [App\Http\Controllers\inventarioController::class, 'getpistolear']);

Route::get('/productosall', [App\Http\Controllers\inventarioController::class, 'productosall']);

Route::get('/productos', [App\Http\Controllers\inventarioController::class, 'index']);

Route::get('/pdf/{cantidad}/{producto}/{tipo}', [App\Http\Controllers\inventarioController::class, 'pdf']);
