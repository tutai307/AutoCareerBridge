<?php

use App\Http\Controllers\Company\CompanyController;
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
    'as' => 'company.'
], function () {
    Route::get('profile/{slug}', [CompanyController::class, 'profile'])->name('profile');
    Route::get('profile/edit/{slug}', [CompanyController::class, 'edit'])->name('profileEdit');
    Route::put('profile/edit/{slug}', [CompanyController::class, 'updateProfile'])->name('profileUpdate');
    Route::patch('profile/updateAvatar/{slug}', [CompanyController::class, 'updateImage'])->name('profileUpdateAvatar');
    Route::get('districts/{province_id}', [CompanyController::class, 'getDistricts']);
    Route::get('wards/{district_id}', [CompanyController::class, 'getWards']);
});

