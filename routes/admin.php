<?php

use App\Http\Controllers\Admin\FieldsController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\JobsController;
use App\Http\Controllers\Admin\MajorsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\WorkshopsController;
use App\Http\Controllers\NotificationsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Management\LoginController;
use App\Http\Controllers\Auth\Management\RegistersController;

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


Route::group(['prefix' => 'management', 'as' => 'management.'], function () {
    Route::get('register', [RegistersController::class, 'viewResgister'])->name('register');
    Route::post('postRegister', [RegistersController::class, 'postResgister'])->name('postResgister');
    Route::get('register-confirm', [RegistersController::class, 'registerConfirm'])->name('registerConfirm');
    Route::get('confirm-mail-register', [RegistersController::class, 'confirmMailRegister'])->name('confirmMailRegister');

    Route::get('/', [LoginController::class, 'viewLogin'])->name('login');
    Route::post('check-login', [LoginController::class, 'checkLogin'])->name('checkLogin');
    Route::get('forgot-password', [LoginController::class, 'viewForgotPassword'])->name('forgotPassword');
    Route::post('forgot-password-check', [LoginController::class, 'checkForgotPassword'])->name('checkForgotPassword');
    Route::get('change-password', [LoginController::class, 'viewChangePassword'])->name('viewChangePassword');
    Route::post('post-password', [LoginController::class, 'postPassword'])->name('postPassword');

    Route::post('logout/{id}', [LoginController::class, 'logout'])->name('logout');
});

Route::get('notifications', [NotificationsController::class, 'index'])->name('notifications');
Route::get('notifications/seen', [NotificationsController::class, 'seen'])->name('notifications.seen');
Route::delete('notifications/destroy/{id}', [NotificationsController::class, 'destroy'])->name('notifications.destroy');

Route::prefix('admin')
    ->as('admin.')
    ->middleware('check.admin')
    ->group(function () {
        Route::get('/', [HomeController::class, 'dashboard'])->name('home');
        Route::post('get-jobs-chart', [HomeController::class, 'getJobChart'])->name('getJobChart');

        Route::get('get-data-chart', [JobsController::class, 'getDataChart'])->name('getDataChart');
        Route::resource('users', UsersController::class)->except('show');
        Route::post('/user/toggle-status', [UsersController::class, 'toggleStatus'])->name('user.toggleStatus');
        Route::resource('jobs', JobsController::class);
        Route::get('jobs/detail/{slug}', [JobsController::class, 'showBySlug'])->name('jobs.slug');
        Route::post('jobs/update-status/', [JobsController::class, 'updateStatus'])->name('jobs.updateStatus');
        Route::resource('workshops', WorkshopsController::class);
        Route::get('workshops/detail/{slug}', [WorkshopsController::class, 'showBySlug'])->name('workshops.slug');
        Route::patch('fields/change-status', [FieldsController::class, 'changeStatus'])->name('fields.changeStatus');
        Route::resource('fields', FieldsController::class);
        Route::patch('majors/change-status', [MajorsController::class, 'changeStatus'])->name('majors.changeStatus');
        Route::resource('majors', MajorsController::class);
    });
