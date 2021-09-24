<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\BookController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route:: get('/about', function (){
    return view('about');
});



Route::get('/header', function () {
    return view('layouts.header');
});
Route::resource('/batch', BatchController::class);

Route::get('/test', function(){
    return view('testLogin');
});

Route::resource('/book', BookController::class);

