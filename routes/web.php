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
Route::get('/publication/{id}', [App\Http\Controllers\UserController::class, 'publicacion'])
    ->where('id', '[0-9]+')
    ->name('user.edit-publicacion');
Route::post('/publication', [App\Http\Controllers\UserController::class, 'storePublication'])->name('user.store-publicacion');
Route::delete('publication/{id}', [App\Http\Controllers\UserController::class, 'destroyPublication'])->middleware('auth')->name('series.destroy');
Route::delete('publication/chapter/{id}', [App\Http\Controllers\UserController::class, 'deleteChapter'])->middleware('auth')->name('chapter.destroy');
Route::get('/publication/{id}/chapters',  [App\Http\Controllers\UserController::class, 'manageChapters'])->name('publication.manage');
Route::get('/publication/{id}/chapter',  [App\Http\Controllers\UserController::class, 'uploadChapter'])->name('publication.uploadchapter');
Route::get('/publication/{id}/chapter/{idchapter}',  [App\Http\Controllers\UserController::class, 'uploadChapter'])->name('publication.uploadeditchapter');
Route::post('/publication/newchapter', [App\Http\Controllers\ChapterController::class, 'store'])->name('chapter.store');


//profile
Route::get('/u/{nickname}', [App\Http\Controllers\HomePublicController::class, 'showPublicProfile'])->name('user.public-profile');
Route::get('/manage-account', [App\Http\Controllers\UserController::class, 'manageAccountView'])->name('user.manage-account');
Route::post('/manage-account/update-account-info', [App\Http\Controllers\UserController::class, 'updateAccountInfo'])->name('user.update-account-info');
Route::get('/manage-profile', [App\Http\Controllers\UserController::class, 'manageProfileView'])->name('user.manage-profile');
Route::post('/manage-account/update-profile-info', [App\Http\Controllers\UserController::class, 'updateProfileInfo'])->name('user.update-profile-info');

Route::get('/auth/google', 'App\Http\Controllers\Auth\LoginController@redirectToGoogle')->name('login.google');
Route::get('/auth/google/callback', 'App\Http\Controllers\Auth\LoginController@handleGoogleCallback');

Route::get("/following", "App\Http\Controllers\UserController@followingSeries")->name("series.following");
Route::get("/search", "App\Http\Controllers\HomePublicController@search")->name("search");
Route::get("/search/{q}", "App\Http\Controllers\HomePublicController@search")->name("filter.search");

Route::post('/series/{serie_id}/follow', 'App\Http\Controllers\UserController@follow')->name('serie.follow');
Route::post('/series/{serie_id}/unfollow', 'App\Http\Controllers\UserController@unfollow')->name('serie.unfollow');
