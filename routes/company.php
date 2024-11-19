<?php

use App\Http\Controllers\Company\CompaniesController;
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
    'middleware' => 'check.company'
], function () {
    Route::get('/', function () {
        return view('management.pages.home');
    })->name('home');
    Route::get('profile', [CompaniesController::class, 'profile'])->name('profile');
    Route::get('profile/edit/{slug}', [CompaniesController::class, 'edit'])->name('profileEdit');
    Route::put('profile/edit/{slug}', [CompaniesController::class, 'updateProfile'])->name('profileUpdate');
    Route::patch('profile/updateAvatar/{slug}', [CompaniesController::class, 'updateImage'])->name('profileUpdateAvatar');
    Route::get('provinces', [CompaniesController::class, 'getProvinces']);
    Route::get('districts/{province_id}', [CompaniesController::class, 'getDistricts']);
    Route::get('wards/{district_id}', [CompaniesController::class, 'getWards']);
});
