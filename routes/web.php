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

Route::get('/teacher/dashboard', [App\Http\Controllers\TeacherController::class, 'dashboard'])->name('teacher.dashboard');

Route::get('/coordinator/dashboard', function(){
    return view('coordinator.dashboard');
});


// Admin Route
Route::group(['prefix' => 'admin','middleware' => 'auth'], function(){

    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class,'dashboard'])->name('admin.dashboard');

    Route::group(['namespace' => 'Admin'], function(){
        Route::resource('/role', RoleController::class);
        Route::post('/role/search', [App\Http\Controllers\Admin\RoleController::class,'searchRoles'])->name('role.search');

        Route::resource('/permission', PermissionController::class);

        Route::get('/batch/{course}/create', [App\Http\Controllers\Admin\BatchController::class, 'create'])->name('course.batch.create');
        Route::resource('/batch', BatchController::class);

        Route::get('/course/{course}/batches', [App\Http\Controllers\Admin\CourseController::class, 'batch_index'])->name('course.batches');
        Route::resource('/course', CourseController::class);

        Route::resource('/semester', SemesterController::class);

        Route::get('/subject/create/{course}', [App\Http\Controllers\Admin\SubjectController::class, 'create'])->name('course.subject.create');
        Route::resource('/subject', SubjectController::class);

        Route::get('/course/newSession/{course}', [App\Http\Controllers\Admin\AdmissionController::class, 'createNewSession'])->name('course.newSession');
        Route::post('/course/newSession/store', [App\Http\Controllers\Admin\AdmissionController::class, 'storeNewSession'])->name('course.newSession.store');
        Route::get('/admission/response', function(){
            return view('admin.admission.response');
        });
        Route::get('/admission/closed/{batch}',[App\Http\Controllers\Admin\AdmissionController::class, 'endSession'])->name('admission.closed');

        // Admin
        Route::get('/students-list', [App\Http\Controllers\Admin\AdminController::class, 'listOfStudents'])->name('students.list');
        Route::get('/select-batch/{course}', [App\Http\Controllers\Admin\AdminController::class, 'selectBatch'])->name('select.batch');
        Route::get('/student/performance/{student}', [App\Http\Controllers\Admin\AdminController::class, 'studentPerformance'])->name('student.performance');
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
Route::get('/admission/response',[App\Http\Controllers\Admin\AdmissionController::class, 'Response'])->name('admission.response');
Route::get('/admission/details/{admission}',[App\Http\Controllers\Admin\AdmissionController::class, 'admissionDetails'])->name('admission.details');

//Co-ordinator Route
Route::group(['prefix'=>'coordinator', 'middleware' => 'auth', 'namespace' => 'Coordinator'], function(){
    Route::resource('/classroom', ClassroomController::class)->except(['index']);
    Route::get('/rooms/{batch}', [App\Http\Controllers\Coordinator\ClassroomController::class, 'index'])->name('classroom.index');
    Route::post('/classroom/addStudents', [App\Http\Controllers\Coordinator\ClassroomController::class, 'addStudents'])->name('classroom.addStudents');
    Route::post('/classroom/addTeachers', [App\Http\Controllers\Coordinator\ClassroomController::class, 'addTeachers'])->name('classroom.addTeachers');
    Route::delete('/classroom/removeTeacher/{teacher}', [App\Http\Controllers\Coordinator\ClassroomController::class, 'removeTeacher'])->name('classroom.removeTeacher');
    Route::delete('/classroom/removeStudent/{student}', [App\Http\Controllers\Coordinator\ClassroomController::class, 'removeStudent'])->name('classroom.removeStudent');
    Route::post('/classroom/status', [App\Http\Controllers\Coordinator\ClassroomController::class, 'status'])->name('classroom.status');

    Route::resource('/examination', ExaminationController::class);
    Route::get('/select-batch/{course}', [App\Http\Controllers\Coordinator\ExaminationController::class, 'selectBatch']);

    //Result
    Route::resource('/result', ResultController::class)->except(['index']);

});
Route::get('/classroom/{classroom}', [App\Http\Controllers\Coordinator\ClassroomController::class, 'classroom'])->name('classroom.dashboard');

// Classroom Topic
Route::resource('/classroom/topic', Classroom\TopicController::class);

// Classroom Attendance
Route::resource('/classroom/attendance', Classroom\AttendanceController::class)->except(['index']);
Route::get('/classroom/{classroom}/attendance', [App\Http\Controllers\Classroom\AttendanceController::class, 'index'])->name('attendance.index');
Route::post('/classroom/{classroom}/attendance/retrieveData', [App\Http\Controllers\Classroom\AttendanceController::class, 'reterieveData'])->name('attendance.retrieveData');

// Classroom Assignment
Route::resource('/classroom/assignment', Classroom\AssignmentController::class)->except(['index']);
Route::get('/classroom/{classroom}/assignment', [App\Http\Controllers\Classroom\AssignmentController::class, 'index'])->name('assignment.index');
Route::get('/classroom/{classroom}/assignmentEvaluation', [App\Http\Controllers\Classroom\AssignmentController::class, 'studentAssignmentEvaluation'])->name('assignment.evaluation');
Route::post('/assignment/marksEvaluation', [App\Http\Controllers\Classroom\AssignmentController::class, 'marksEvaluation'])->name('assignment.marksEvaluation');
Route::post('/assignment/submit', [App\Http\Controllers\Classroom\AssignmentController::class, 'submit'])->name('assignment.submit');

// Assignment - Student Work
Route::resource('/classroom/assignment/studentWork', Classroom\AssignmentPointController::class)->except(['index']);
Route::get('/classroom/assignment/{assignment}/studentWork',[ App\Http\Controllers\Classroom\AssignmentPointController::class, 'index'])->name('studentWork.index');

// Comment
Route::post('/addComment', [App\Http\Controllers\Classroom\CommentController::class, 'addComment'])->name('comment.store');

// Student New Admission
// Route::get('student/create/{course}/{batch}', [StudentController::class, 'create'])->name('student.create');
Route::post('/student', [StudentController::class, 'store'])->name('student.store');
Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard')->middleware('auth');
Route::get('classroom/{classroom}/student/performance/{student}', [StudentController::class, 'studentPerformance'])->name('classroom.student.performance');

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


Route::get('/result/{examination}/subject/{subject}', [App\Http\Controllers\Coordinator\ResultController::class, 'index'])->name('result.index');

Route::post('/update/table', [App\Http\Controllers\Coordinator\ExaminationController::class, 'updateTable'])->name('update.table');

Route::post('/examination/publish', [App\Http\Controllers\Coordinator\ExaminationController::class, 'examinationPublish'])->name('examination.publish');


Route::get('/student/performance/{semester}/{batch}', [App\Http\Controllers\StudentPerformanceController::class, 'ScholarshipEvaluation'])->name('student.scholarship');
