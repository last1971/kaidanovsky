<?php

use App\Http\Controllers\PostcardController;
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

Route::view('/test', 'under')->name('under');
Route::view('/', 'welcome')->name('welcome');
Route::view('/dark', 'dark')->name('dark');
Route::view('/light', 'light')->name('light');
Route::view('/oferta', 'oferta')->name('oferta');
Route::view('/bank', 'bank')->name('bank');
Route::view('/privacy', 'privacy')->name('privacy');

Route::post('/test', function (){
   dd(request());
});

Route::get('/create-order', [PostcardController::class, 'createOrder'])->name('create-order');

Route::post('/create', [PostcardController::class, 'create'])->name('create');

Route::get('/success', [PostcardController::class, 'success'])->name('success');

Route::get('/order/{order}', [PostcardController::class, 'order'])->name('order');


