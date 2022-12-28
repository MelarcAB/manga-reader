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



//Login y registro
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomePublicController::class, 'index'])->name('main');

//ver detalles serie
Route::get('/serie/{id}', 'App\Http\Controllers\SerieController@show')
    ->where('id', '[0-9]+')
    ->name('serie.show');

//ver detalles capitulo
Route::get('chapters/{id}', 'App\Http\Controllers\ChapterController@showPages')->name('chapter.pages');
