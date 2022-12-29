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

//user gestionar publicaciones
Route::get('/publications', [App\Http\Controllers\UserController::class, 'publicaciones'])->name('user.publicaciones');
Route::get('/publication', [App\Http\Controllers\UserController::class, 'publicacion'])->name('user.publicacion');
Route::get('/publication/{id}', [App\Http\Controllers\UserController::class, 'publicacion'])->name('user.edit-publicacion');
Route::post('/publication', [App\Http\Controllers\UserController::class, 'storePublication'])->name('user.store-publicacion');
Route::delete('publication/{id}', [App\Http\Controllers\UserController::class, 'destroyPublication'])->middleware('auth')->name('series.destroy');
Route::delete('publication/chapter/{id}', [App\Http\Controllers\UserController::class, 'deleteChapter'])->middleware('auth')->name('chapter.destroy');
Route::get('/publication/{id}/chapters',  [App\Http\Controllers\UserController::class, 'manageChapters'])->name('publication.manage');
Route::get('/publication/{id}/chapter',  [App\Http\Controllers\UserController::class, 'uploadChapter'])->name('publication.uploadchapter');
Route::post('/publication/newchapter', [App\Http\Controllers\ChapterController::class, 'store'])->name('chapter.store');
