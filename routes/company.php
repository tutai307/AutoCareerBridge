<?php

use App\Http\Controllers\Admin\CompanyController;
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



Route::get('company/profile/{slug}', [CompanyController::class, 'profile'])->name('companyProfile');
Route::get('company/profile/edit/{slug}', [CompanyController::class, 'edit'])->name('companyProfileEdit');
Route::put('company/profile/edit/{slug}', [CompanyController::class, 'updateProfile'])->name('companyProfileUpdate');
Route::patch('company/profile/updateAvatar/{slug}', [CompanyController::class, 'updateImage'])->name('companyProfileUpdateAvatar');
Route::get('/districts/{province_id}', [CompanyController::class, 'getDistricts']);
Route::get('/wards/{district_id}', [CompanyController::class, 'getWards']);
