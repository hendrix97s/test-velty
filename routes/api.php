<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\PredioController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\TipagemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1'], function (){
  Route::resource('cliente', ClienteController::class)
    ->only(['index', 'show', 'store', 'update', 'destroy'])
    ->parameters(['cliente' => 'uuid']);

  Route::resource('cliente/{uuid}/predio', PredioController::class)
    ->only(['index', 'store'])
    ->parameters(['predio' => 'uuid']);

  Route::resource('cliente/{uuid}/endereco', EnderecoController::class)
    ->only(['update', 'destroy', 'store'])
    ->parameters(['endereco' => 'endereco_uuid'])
    ->names([
      'update'  => 'cliente.endereco.update',
      'destroy' => 'cliente.endereco.destroy',
      'store'   => 'cliente.endereco.store',
    ]);

  Route::resource('predio', PredioController::class)->only(['show', 'update', 'destroy'])
    ->parameters(['predio' => 'uuid']);

  Route::resource('predio/{uuid}/endereco', EnderecoController::class)
  ->only(['update', 'destroy', 'store'])
  ->parameters(['endereco' => 'endereco_uuid'])    
  ->names([
    'update'  => 'predio.endereco.update',
    'destroy' => 'predio.endereco.destroy',
    'store'   => 'predio.endereco.store'
  ]);

  Route::get('predio/{uuid}/foto', [PredioController::class, 'listFotos'])->name('predio.foto.index');
  Route::resource('predio/{uuid}/foto', FotoController::class)
    ->only(['store', 'destroy', 'update'])
    ->parameters(['foto' => 'foto_uuid'])
    ->names([
      'store'   => 'predio.foto.store',
      'destroy' => 'predio.foto.destroy',
      'update'  => 'predio.foto.update'
    ]);

  Route::get('sala/{uuid}/foto', [SalaController::class, 'listFotos'])->name('sala.foto.index');
  Route::resource('sala/{uuid}/foto', FotoController::class)
  ->only(['store', 'destroy', 'update'])
  ->parameters(['foto' => 'foto_uuid'])
  ->names([
    'store'   => 'sala.foto.store',
    'destroy' => 'sala.foto.destroy',
    'update'  => 'sala.foto.update'
  ]);
  
  
  Route::resource('predio/{uuid}/sala', SalaController::class)
    ->only(['index', 'store', 'destroy', 'update', 'show'])
    ->parameters(['sala' => 'sala_uuid']);

  Route::resource('/tipagem', TipagemController::class)
    ->only(['index', 'store', 'destroy', 'update'])
    ->parameters(['tipagem' => 'uuid']);
});