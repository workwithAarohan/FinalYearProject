<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BatchController;
use App\Http\Controllers\SubjectController;


use App\Http\Controllers\EventController;
use App\Http\Controllers\NoticeController;

use App\Http\Controllers\BookController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Mail\MailController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Auth;

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

Route::resource('/subject', SubjectController::class);

Route::get('/test', function(){
    return view('test');
});

Route::resource('/book', BookController::class);

// Route::get('/send-mail',  [MailController::class, 'sendMail']);


Route::get('/form', function(){
    return view('partials.form');
});

Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::post('/search/users', [SearchController::class, 'searchUsers'])->name('search.users');

Route::get('/welcome', [WelcomeController::class, 'admissionOpen'])->name('welcome');

