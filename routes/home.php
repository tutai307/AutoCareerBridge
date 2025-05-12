<?php

namespace App\Http\Controllers\Clients;


use App\Http\Controllers\Admin\FieldsController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\JobsController;
use App\Http\Controllers\Admin\MajorsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\WorkshopsController;
use App\Http\Controllers\NotificationsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Management\RegistersController;
use App\Http\Controllers\ManageCVController;
use App\Http\Controllers\Student\ApplyJobController;
use App\Http\Controllers\Student\JobRecommendController;
use App\Http\Controllers\Student\LoginController;
use App\Http\Controllers\Student\ManageAccountController;
use App\Http\Controllers\Student\NotificationController;

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
Route::get('career', [JobRecommendController::class, 'index'])->name('home.index');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('home.showLoginForm');
Route::post('login', [LoginController::class, 'login'])->name('home.login');
Route::post('logout', [LoginController::class, 'logout'])->name('home.logout');
Route::get('forgot-password', [LoginController::class, 'forgotPassword'])->name('home.forgot-password');

Route::get('career/job/{slug}', [JobRecommendController::class, 'detailJob'])->name('home.detailJob');

Route::middleware('auth:student')->group(function () {
    Route::get('manage-cv', [ManageCVController::class, 'index'])->name('home.manageCV');
    Route::post('manage-cv', [ManageCVController::class, 'store'])->name('home.manageCV.store');
    Route::post('set-main', [ManageCVController::class, 'setMain'])->name('home.manageCV.setMain');
    Route::put('edit-cv', [ManageCVController::class, 'edit'])->name('home.manageCV.edit');
    Route::delete('delete-cv', [ManageCVController::class, 'delete'])->name('home.manageCV.delete');

    Route::post('apply-job', [ApplyJobController::class, 'applyJob'])->name('home.applyJob');
    Route::get('/student/notifications', [NotificationController::class, 'getNotifications']);
    Route::post('/student/notifications/mark-read', [NotificationController::class, 'markAsRead']);

    // Route hiển thị trang quản lý tài khoản
    Route::get('/manage-account', [ManageAccountController::class, 'index'])->name('manageAccount.index');

    // Route xử lý cập nhật thông tin cá nhân
    Route::put('/manage-account/profile', [ManageAccountController::class, 'updateProfile'])->name('manageAccount.updateProfile');

    // Route xử lý đổi mật khẩu
    Route::put('/manage-account/password', [ManageAccountController::class, 'updatePassword'])->name('manageAccount.updatePassword');
});
