<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Mail\MailController;
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
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('dashboard');

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

        Route::get('/{student}', [StudentController::class, 'show'])->name('show');
    });

});


Route::get('student/create', [StudentController::class, 'create'])->name('student.create');
Route::post('/student', [StudentController::class, 'store'])->name('student.store');

Route::get('/send-enrollment', [App\Http\Controllers\StudentEnrollmentController::class, 'sendEnrollmentNotification']);

Route::get('/notification', function () {
    return view('notification.index');
})->name('notification.index');


Route::prefix('/notificaiton')->group(function () {
    Route::get('/markAsRead/{notificationId}', [App\Http\Controllers\StudentEnrollmentController::class, 'markAsRead'])->name('notification.markAsRead');
    Route::get('/notification/delete/{notificationId}', [App\Http\Controllers\StudentEnrollmentController::class, 'deleteNotification'])->name('notification.delete');
});


Route::get('/enrolledStudent/info/{studentId}', [App\Http\Controllers\StudentEnrollmentController::class, 'StudentInfo'])->name('enrolledStudent.info');

Route::resource('/event', EventController::class);

Route::resource('/notice', NoticeController::class);

Route::get('/test', function(){
    return view('testLogin');
});

Route::resource('/book', BookController::class);

Route::get('/send-mail',  [MailController::class, 'sendMail']);


Route::get('/form', function(){
    return view('partials.form');
});
