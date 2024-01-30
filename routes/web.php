<?php

use App\Http\Controllers\Home;
use App\Http\Controllers\Team;
use App\Http\Controllers\Article;
use App\Http\Controllers\Artists;
use App\Http\Controllers\Streaming;
use App\Http\Controllers\Additional;
use App\Http\Controllers\Aftermovie;
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
Route::get('/article', [Article::class, 'index']);
Route::get('/aftermovie', [Aftermovie::class, 'index']);
Route::get('/team', [Team::class, 'index']);
Route::get('/home', [Home::class, 'index']);
Route::get('/streaming', [Streaming::class, 'index']);
Route::get('/', [Home::class, 'index']);
Route::get('/{page}', [Home::class, 'index']);
Route::get('/page/{page}', [Additional::class, 'index']);