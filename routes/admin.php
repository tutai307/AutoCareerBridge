<?php

use App\Http\Controllers\Admin\JobsController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

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

Route::get('/admin', function () {
    return view('management.pages.home');
})->name('admin.dashboard');

Route::prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::resource('users', UsersController::class);
        Route::resource('jobs', JobsController::class);
        Route::get('jobs/detail/{slug}', [JobsController::class, 'showBySlug'])->name('jobs.slug');
        Route::post('jobs/update-status/', [JobsController::class, 'updateStatus'])->name('jobs.updateStatus');
    });
