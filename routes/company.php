<?php

use App\Http\Controllers\Company\CompaniesController;
use App\Http\Controllers\Company\HiringsController;
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
    'middleware' => ['check.company','check.company.isEmpty']
], function () {
    Route::get('/', function () {
        return view('management.pages.company.dashboard.dashBoard');
    })->name('home');

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
});

