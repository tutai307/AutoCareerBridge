<?php

use App\Http\Controllers\Company\CollaborationsController;
use App\Http\Controllers\Company\CompaniesController;
use App\Http\Controllers\Company\HiringsController;
use App\Http\Controllers\Company\JobsController;
use App\Http\Controllers\Company\MajorsController;
use App\Http\Controllers\University\WorkShopsController;
use App\Models\Collaboration;
use App\Models\WorkShop;
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
    Route::post('get-job-chart', [CompaniesController::class, 'getJobChart'])->name('getJobChart');
    Route::get('profile', [CompaniesController::class, 'profile'])->name('profile');
    Route::get('profile/edit/{slug}', [CompaniesController::class, 'edit'])->name('profileEdit');
    Route::put('profile/edit/{slug}', [CompaniesController::class, 'updateProfile'])->name('profileUpdate');

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
    Route::post('collaboration/change-status', [CollaborationsController::class, 'changeStatus'])->name('changeStatusColab');
    Route::delete('collaboration/delete/{id}', [CollaborationsController::class, 'delete'])->name('collaboration.delete');
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
    Route::get('manage-university-job', [JobsController::class, 'manageUniversityJob'])->name('manageUniversityJob');
    Route::get('manage-university-job/change-status/{id}/{status}', [JobsController::class, 'updateStatus'])->name('updateStatus');
    Route::post('workshop/apply/{companyId}/{workshopId}', [WorkShopsController::class, 'applyWorkshop'])->name('workshop.apply');
    Route::get('/workshops/applied', [WorkShopsController::class, 'workshopApplied'])->name('workshops.applied');

});
