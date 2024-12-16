<?php

use App\Http\Controllers\Company\CollaborationsController;
use App\Http\Controllers\Company\CompaniesController;
use App\Http\Controllers\Company\HiringsController;
use App\Http\Controllers\Company\JobsController;
use App\Http\Controllers\Company\MajorsController;
use App\Models\Collaboration;
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


Route::group([
    'prefix' => 'company',
    'as' => 'company.',
    'middleware' => ['check.company', 'check.company.isEmpty']
], function () {
    Route::get('/', [CompaniesController::class, 'dashboard'])->name('home');
    Route::get('profile', [CompaniesController::class, 'profile'])->name('profile');
    Route::get('profile/edit/{slug}', [CompaniesController::class, 'edit'])->name('profileEdit');
    Route::put('profile/edit/{slug}', [CompaniesController::class, 'updateProfile'])->name('profileUpdate');
    Route::patch('profile/updateAvatar/{slug}', [CompaniesController::class, 'updateImage'])->name('profileUpdateAvatar');

    Route::get('manage-hiring', [HiringsController::class, 'index'])->name('manageHiring');
    Route::get('manage-hiring/create', [HiringsController::class, 'create'])->name('create');
    Route::post('manage-hiring/store', [HiringsController::class, 'store'])->name('store');
    Route::get('manage-hiring/edit/{id}', [HiringsController::class, 'edit'])->name('editHiring');
    Route::put('manage-hiring/update/{userId}', [HiringsController::class, 'update'])->name('updateHiring');
    Route::delete('manage-hiring/delete/{id}', [HiringsController::class, 'deleteHiring'])->name('deleteHiring');
    Route::get('search-university', [CompaniesController::class, 'searchUniversity'])->name('searchUniversity');

    Route::get('manage-collaboration', [CollaborationsController::class, 'index'])->name('collaboration');

    Route::get('/major', [MajorsController::class, 'index'])->name('majorCompany');
    Route::get('/major/create', [MajorsController::class, 'create'])->name('createMajorCompany');
    Route::post('/major/store', [MajorsController::class, 'store'])->name('storeMajorCompany');
    Route::delete('/major/delete/{majorId}', [MajorsController::class, 'delete'])->name('deleteMajorCompany');
});

Route::group([
    'prefix' => 'company',
    'as' => 'company.',
    'middleware' => ['check.hiring.or.company'],
], function () {
    Route::get('manage-job', [JobsController::class, 'index'])->name('manageJob');
    Route::get('manage-job/create', [JobsController::class, 'create'])->name('createJob');
    Route::post('manage-job/store', [JobsController::class, 'store'])->name('storeJob');
    Route::get('manage-job/edit/{slug}', [JobsController::class, 'edit'])->name('editJob');
    Route::put('manage-job/update/{id}', [JobsController::class, 'update'])->name('updateJob');
    Route::delete('manage-job/delete/{id}', [JobsController::class, 'destroy'])->name('deleteJob');
    Route::get('manage-job/detail/{slug}', [JobsController::class, 'show'])->name('showJob');
});
