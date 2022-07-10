<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Movie;

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
    return view('app');
});

Route::get('/movie', [Movie::class,'getAll']);
Route::post('/movie', [Movie::class,'store']);
Route::put('/movie/{id}', [Movie::class,'update']);
Route::delete('/movie/{id}', [Movie::class,'delete']);
