<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\BatchController;
use App\Http\Controllers\Admin\CourseController;

use App\Http\Controllers\EventController;
use App\Http\Controllers\NoticeController;

use App\Http\Controllers\BookController;

use App\Http\Controllers\HomeController;




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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route:: get('/about', fn() => view('about'));

Route::get('/header', function () {
    return view('layouts.header');
});

// Route::resource('/admin/batch', BatchController::class);
// Route::resource('/admin/course', CourseController::class);

Route::group([
    'prefix' => 'admin',
    'middleware' => 'auth'], function()
    {
        Route::resource('/batch', BatchController::class);
        Route::resource('/course', CourseController::class);
});

Route::resource('/event', EventController::class);

Route::resource('/notice', NoticeController::class);

Route::get('/test', function(){
    return view('testLogin');
});

Route::resource('/book', BookController::class);

