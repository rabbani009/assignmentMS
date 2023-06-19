<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthControllers\{
    ForgotPasswordController,
    LoginController,
    LogoutController,
    RegisterController,
    ResetPasswordController,
};
use App\Http\Controllers\BackendControllers\{
    
    DashboardController,
    OfficeController,
    DepartmentController,
    EmployeeController,
    AjaxController,
    CheckTimeController,
    UserInfoController,
    AttendencelogController,
    EmployeeAttendenceController,
    ReportController


};

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

Route::get('/', [HomeController::class, 'getHome'])->name('home');

Route::group(['namespace' => 'AuthControllers'], function () {
    Route::get('login', [LoginController::class, 'getLogin'])->name('get.login');
    Route::post('login', [LoginController::class, 'postLogin'])->name('post.login');

    Route::get('logout', [LogoutController::class, 'getLogout'])->name('get.logout');
    Route::post('logout', [LogoutController::class, 'postLogout'])->name('post.logout');

    Route::get('register', [RegisterController::class, 'getRegister'])->name('get.register');
    Route::post('register', [RegisterController::class, 'postRegister'])->name('post.register');

    Route::get('forgot-password', [ForgotPasswordController::class, 'getForgotPassword'])->name('get.forgot.password');
    Route::post('forgot-password', [ForgotPasswordController::class, 'postForgotPassword'])->name('post.forgot.password');

    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'getResetPassword'])->name('get.reset.password');
    Route::post('reset-password', [ForgotPasswordController::class, 'postResetPassword'])->name('post.reset.password');
});


Route::group(['prefix' => 'backend', 'middleware' => 'authenticated'], function () {
    Route::get('dashboard', [DashboardController::class, 'getDashboard'])->name('get.dashboard');
    Route::resource('office', OfficeController::class);
    Route::resource('department', DepartmentController::class);
    Route::resource('employee', EmployeeController::class);


    // Route::get('/view', [UserChecktimeController::class, 'csvview'])->name('view');
    // Route::post('/import', [UserChecktimeController::class, 'import'])->name('import');

    //excel import routes.....
    Route::get('/checktime', [CheckTimeController::class, 'index'])->name('checktime.index');
    Route::post('/checktime', [CheckTimeController::class, 'store'])->name('checktime.store');

      //excel UserInfoimport routes.....
      Route::get('/userinfo', [UserInfoController::class, 'index'])->name('userinfo.index');
      Route::post('/userinfo', [UserInfoController::class, 'store'])->name('userinfo.store');

      //AttendenceLog
      Route::get('/insert-attendance', [AttendencelogController::class, 'index'])->name('attendence.index');

      //generate attendence

      Route::get('/attendance', [EmployeeAttendenceController::class, 'index'])->name('empattendence.index');

      Route::get('/attendance/show', [EmployeeAttendenceController::class, 'show'])->name('attendance.show');

      //Monthly report 

      Route::get('/attendance/report', [ReportController::class, 'index'])->name('report.index');

      Route::post('/generated/report', [ReportController::class, 'generateReport'])->name('report.show');


     



});


Route::group(['prefix' => 'ajax', 'as' => 'ajax.'], function (){
    Route::post('get-department-by-office', [AjaxController::class, 'getDepartmentsByOffice'])->name('get-department-by-office');
    

});

















