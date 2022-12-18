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

Route::get('/inventariofull', [App\Http\Controllers\HomeController::class, 'inventariofull']);

Route::get('/inventariofullfabricalonline', [App\Http\Controllers\HomeController::class, 'inventariofullfabricalonline']);

Route::get('/despachodrima', [App\Http\Controllers\HomeController::class, 'despachodrima']);

Route::get('/despachofabricalonline', [App\Http\Controllers\HomeController::class, 'despachofabricalonline']);

Route::get('/despachomercadolibre', [App\Http\Controllers\HomeController::class, 'despachomercadolibre']);

Route::get('/despachofalabella', [App\Http\Controllers\HomeController::class, 'despachofalabella']);

Route::get('/agregarproducto', [App\Http\Controllers\HomeController::class, 'producto']);

Route::get('/agregararticulo', [App\Http\Controllers\HomeController::class, 'agregararticulo']);




Route::post('/pistolear/{id}/{plataforma}', [App\Http\Controllers\inventarioController::class, 'pistolear']);

Route::get('/getpistolear/{id}', [App\Http\Controllers\inventarioController::class, 'getpistolear']);

Route::get('/productosall', [App\Http\Controllers\inventarioController::class, 'productosall']);

Route::get('/productosallfabricalonline', [App\Http\Controllers\inventarioController::class, 'productosallfabricalonline']);

Route::get('/productosallmercadolibre', [App\Http\Controllers\inventarioController::class, 'productosallmercadolibre']);

Route::get('/productosallfalabella', [App\Http\Controllers\inventarioController::class, 'productosallfalabella']);

Route::get('/productos', [App\Http\Controllers\inventarioController::class, 'index']);

Route::get('/pdf/{cantidad}/{producto}', [App\Http\Controllers\inventarioController::class, 'pdf']);

Route::get('/getdespachodrima', [App\Http\Controllers\inventarioController::class, 'getdespachodrima']);

Route::get('/getdespachofabricalonline', [App\Http\Controllers\inventarioController::class, 'getdespachofabricalonline']);

Route::get('/getdespachomercadolibre', [App\Http\Controllers\inventarioController::class, 'getdespachomercadolibre']);

Route::get('/getdespachofalabella', [App\Http\Controllers\inventarioController::class, 'getdespachofalabella']);

Route::post('/agregararticulo/{nombre_producto}/{marca}/{titulo}/{descripcion}', [App\Http\Controllers\inventarioController::class, 'postarticulo']);