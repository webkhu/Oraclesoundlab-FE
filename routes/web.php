<?php

use App\Http\Controllers\Home;
use App\Http\Controllers\Artists;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/artists', [Artists::class, 'index']);
Route::get('/artists/{slug}', [Artists::class, 'artist']);
Route::get('/', [Home::class, 'index']);