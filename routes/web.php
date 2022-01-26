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





Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('acceuil');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

Route::get('/index', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Auth::routes();

Route::get('/moncompte', [App\Http\Controllers\UserController::class, 'moncompte'])->name('moncompte');

Route::get('/modifier', [App\Http\Controllers\UserController::class, 'modifier'])->name('modifier');

Route::put('/update', [App\Http\Controllers\UserController::class, 'update'])->name('update');

Route::put('/modifiermotdepasse', [App\Http\Controllers\UserController::class, 'modifiermotdepasse'])->name('modifiermotdepasse');

// La partie message sur la page d'acceuil

Route::resource('/messages', App\Http\Controllers\MessageController::class)->except('index');
// commentaires

Route::resource('/commentaire', App\Http\Controllers\CommentController::class)->except('index','create');

Route::get('/commentaire/create/{id}', [App\Http\Controllers\CommentController::class, 'create'])->name('commentaire.create');







