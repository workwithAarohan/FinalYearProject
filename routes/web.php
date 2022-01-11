<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\StudentController;
// use App\Http\Controllers\Coordinator\ClassroomController;
use App\Http\Controllers\Mail\MailController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WelcomeController;
use App\Models\AdmissionWindow;
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
    $admissionWindows = AdmissionWindow::where('is_open',1)->get();
    $admissionWindows->count = AdmissionWindow::where('is_open', 1)->count();

    return view('welcome',[
        'admissionWindows' => $admissionWindows
    ]);
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route:: get('/about', fn() => view('about'));

Route::get('/header', function () {
    return view('layouts.header');
});

// Route::resource('/admin/batch', BatchController::class);
// Route::resource('/admin/course', CourseController::class);


// Admin Route
Route::group(['prefix' => 'admin','middleware' => 'auth'], function(){
    Route::get('/dashboard', function(){
        return view('admin.dashboard');
    });

    Route::group(['namespace' => 'Admin'], function(){
        Route::get('/batch/{course}/create', [App\Http\Controllers\Admin\BatchController::class, 'create'])->name('course.batch.create');
        Route::resource('/batch', BatchController::class);

        Route::get('/course/{course}/batches', [App\Http\Controllers\Admin\CourseController::class, 'batch_index'])->name('course.batches');
        Route::resource('/course', CourseController::class);

        Route::resource('/semester', SemesterController::class);

        Route::get('/subject/create/{course}', [App\Http\Controllers\Admin\SubjectController::class, 'create'])->name('course.subject.create');
        Route::resource('/subject', SubjectController::class);

        Route::get('/course/newSession/{course}', [App\Http\Controllers\Admin\AdmissionController::class, 'createNewSession'])->name('course.newSession');
        Route::post('/course/newSession/store', [App\Http\Controllers\Admin\AdmissionController::class, 'storeNewSession'])->name('course.newSession.store');
        Route::get('/admission/closed/{batch}',[App\Http\Controllers\Admin\AdmissionController::class, 'endSession'])->name('admission.closed');
    });

    Route::group(['prefix' =>'student', 'as' => 'student.'], function(){
        Route::get('/', [StudentController::class, 'index'])->name('index');

        Route::get('/{p}', [StudentController::class, 'show'])->name('show');
    });

    Route::resource('/announcement', AnnouncementController::class);

});

// Admission Form
Route::get('/admission/form/{admissionWindow}',[App\Http\Controllers\Admin\AdmissionController::class, 'admissionForm'])->name('admission.form');
Route::post('/admission/store',[App\Http\Controllers\Admin\AdmissionController::class, 'admissionData'])->name('admission.store');

//Co-ordinator Route
Route::group(['prefix'=>'coordinator', 'middleware' => 'auth', 'namespace' => 'Coordinator'], function(){
    Route::resource('/classroom', ClassroomController::class)->except(['index']);
    Route::get('/rooms/{batch}', [App\Http\Controllers\Coordinator\ClassroomController::class, 'index'])->name('classroom.index');
    Route::post('/classroom/addStudents', [App\Http\Controllers\Coordinator\ClassroomController::class, 'addStudents'])->name('classroom.addStudents');
    Route::post('/classroom/addTeachers', [App\Http\Controllers\Coordinator\ClassroomController::class, 'addTeachers'])->name('classroom.addTeachers');
});
Route::get('/classroom/{classroom}', [App\Http\Controllers\Coordinator\ClassroomController::class, 'classroom'])->name('classroom.dashboard');

// Classroom Topic
Route::resource('/classroom/topic', Classroom\TopicController::class);

// Classroom Assignment
Route::resource('/classroom/assignment', Classroom\AssignmentController::class)->except(['index']);
Route::get('/classroom/{classroom}/assignment', [App\Http\Controllers\Classroom\AssignmentController::class, 'index'])->name('assignment.index');

// Student New Admission
// Route::get('student/create/{course}/{batch}', [StudentController::class, 'create'])->name('student.create');
Route::post('/student', [StudentController::class, 'store'])->name('student.store');
Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard')->middleware('auth');


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

