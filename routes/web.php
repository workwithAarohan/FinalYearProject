<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\StudentController;


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

Route::group(['prefix' => 'admin','middleware' => 'auth'], function(){

    Route::group(['namespace' => 'Admin'], function(){
        Route::resource('/batch', BatchController::class);
        Route::resource('/course', CourseController::class);
    });
        
    Route::group(['prefix' =>'student', 'as' => 'student.'], function(){
        Route::get('/', [StudentController::class, 'index'])->name('index');
        Route::get('/create/{batch}', [StudentController::class, 'create'])->name('create');
        Route::post('/', [StudentController::class, 'store'])->name('store');
        Route::get('/{student}', [StudentController::class, 'show'])->name('show');
    });

});

Route::resource('/event', EventController::class);

Route::resource('/notice', NoticeController::class);

Route::get('/test', function(){
    return view('testLogin');
});

Route::resource('/book', BookController::class);

