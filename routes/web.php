<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\ChapterController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\InforController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\StuLessonController;
use App\Http\Controllers\StuExamController;
use App\Http\Controllers\FeedbackController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/introduction', [HomeController::class, 'introduction'])->name('introduction');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/course-list/{subject_id}', [HomeController::class, 'course_list'])->name('course.list');
Route::get('/course-detail/{course_id}', [HomeController::class, 'course_detail'])->name('course.detail');
Route::get('/new', [HomeController::class, 'new'])->name('new');
Route::get('/new-detail/{new_id}', [HomeController::class, 'new_detail'])->name('new.detail');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'post_contact']);

Route::group([
    'middleware' => 'student'
], function() {
    Route::get('/add-to-cart/{course}', [CartController::class, 'addToCart'])->name('addToCart');
    Route::get('/view-cart', [CartController::class, 'viewCart'])->name('viewCart');
    Route::delete('/delete-cart', [CartController::class, 'deleteCart'])->name('deleteCart');
    Route::post('/vnpay-payment', [PaymentController::class, 'vnpay_payment'])->name('vnpay.payment');
    Route::get('/vnpay-return', [PaymentController::class, 'vnpay_return'])->name('vnpay.return');
    Route::get('/buy-now/{id}', [PaymentController::class, 'buy_now'])->name('vnpay.buy_now');
    Route::get('/course/{course}/lesson/{lesson}', [StuLessonController::class, 'lesson'])->name('lesson');
    Route::get('/exam/{exam}', [StuExamController::class, 'exam'])->name('exam');
    Route::get('/exam-detail/{exam_id}', [StuExamController::class, 'exam_detail'])->name('exam.detail');
    Route::post('/submit-answers', [StuExamController::class, 'submitAnswers'])->name('submit.answers');
    Route::get('/exam/result/{score}', [StuExamController::class, 'exam_result'])->name('exam.result');
    Route::get('/exam/review/{attempt}', [StuExamController::class, 'review'])->name('exam.review');
    Route::post('/rating', [FeedbackController::class, 'rating'])->name('course.rating');
    Route::post('/course-evaluation', [FeedbackController::class, 'evaluation'])->name('course.evaluation');
    Route::get('/my-course', [StuLessonController::class, 'my_course'])->name('mycourse');
    Route::get('/overview-result', [StuExamController::class, 'overview_result'])->name('overview.result');
    Route::get('/overview-exam/{course}', [StuExamController::class, 'overview_exam'])->name('overview.exam');
});

Route::prefix('account')->group(function () {
    Route::get('/login', [AccountController::class, 'login'])->name('account.login');
    Route::post('/login', [AccountController::class, 'check_login']);
    Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout');
    Route::get('/register', [AccountController::class, 'register'])->name('account.register');
    Route::post('/register', [AccountController::class, 'check_register']);
    Route::get('/verify-account/{email}', [AccountController::class, 'verify'])->name('account.verify');
    
    Route::group([
        'middleware' => 'student'
    ], function() {
        Route::get('/profile', [AccountController::class, 'profile'])->name('account.profile');
        Route::post('/profile', [AccountController::class, 'check_profile']);
        Route::post('/change-password', [AccountController::class, 'check_change_password'])->name('account.change_password');
    });

    Route::get('/forgot-password', [AccountController::class, 'forgot_password'])->name('account.forgot_password');
    Route::post('/forgot-password', [AccountController::class, 'check_forgot_password']);

    Route::get('/reset-password/{token}', [AccountController::class, 'reset_password'])->name('account.reset_password');
    Route::post('/reset-password/{token}', [AccountController::class, 'check_reset_password']);
});

Route::get('/admin/login', [DashboardController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [DashboardController::class, 'checklogin']);
Route::get('/admin/logout', [DashboardController::class, 'logout'])->name('admin.logout');

Route::get('/admin/forgotpass', [DashboardController::class, 'forgotpass'])->name('admin.forgotpass');
Route::post('/admin/forgotpass', [DashboardController::class, 'post_forgotpass']);
Route::get('/admin/getpass/{token}', [DashboardController::class, 'getpass'])->name('admin.getpass');
Route::post('/admin/getpass/{token}', [DashboardController::class, 'post_getpass']);

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.index');
    Route::resource('subject', SubjectController::class);
    Route::resource('course', CourseController::class);
    Route::resource('chapter', ChapterController::class);
    Route::resource('lesson', LessonController::class);
    Route::resource('exam', ExamController::class);
    Route::resource('question', QuestionController::class);
    Route::get('question/list/{chapter}', [QuestionController::class, 'list'])->name('question.list');
    Route::get('question/add/{chapter}', [QuestionController::class, 'add'])->name('question.add');
    Route::resource('slider', SliderController::class);
    Route::resource('post', PostController::class);
    Route::resource('infor', InforController::class);
    Route::resource('user', UserController::class);
    Route::post('/uploads-ckeditor', [PostController::class, 'ckeditor_image']);
    Route::get('/lesson/{id}/watch', [LessonController::class, 'watch'])->name('lesson.watch');

    Route::get('/changepass', [DashboardController::class, 'changepass'])->name('admin.changepass');
    Route::post('/changepass', [DashboardController::class, 'post_changepass']);

    Route::get('/profile', [DashboardController::class, 'profile'])->name('admin.profile');
    Route::post('/profile', [DashboardController::class, 'post_profile']);

});