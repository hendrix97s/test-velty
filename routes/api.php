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
  Route::resource('cliente', ClienteController::class)->only(['index', 'show', 'store', 'update', 'destroy'])->parameters(['cliente' => 'uuid']);
  Route::resource('cliente/{uuid}/predio', PredioController::class)->only(['index', 'store'])->parameters(['predio' => 'uuid']);
  Route::post('cliente/{uuid}/endereco', [EnderecoController::class ,'store'])->name('cliente.endereco.store');
  Route::delete('predio/{uuid}', [PredioController::class, 'destroy'])->name('predio.destroy');
  Route::post('predio/{uuid}', [PredioController::class, 'update'])->name('predio.update');
  Route::resource('predio/{uuid}/sala', SalaController::class)->only(['index', 'store']);
  Route::post('predio/{uuid}/endereco', [EnderecoController::class ,'store'])->name('predio.endereco.store');
  Route::resource('predio/{uuid}/foto', FotoController::class)->only(['index', 'store']);
  Route::resource('sala/{uuid}/foto', FotoController::class)->only(['index', 'store']);
  Route::delete('sala/{uuid}', [SalaController::class, 'destroy'])->name('sala.destroy');
  Route::post('sala/{uuid}', [SalaController::class, 'update'])->name('sala.update');
  Route::resource('sala/{uuid}/tipagem', TipagemController::class)->only(['index', 'store']);
  Route::delete('tipagem/{uuid}', [TipagemController::class, 'destroy'])->name('tipagem.destroy');
  Route::post('tipagem/{uuid}', [TipagemController::class, 'update'])->name('tipagem.update');
  Route::resource('/endereco', EnderecoController::class)->only(['update', 'destroy'])->parameters(['endereco' => 'uuid']);
});