<?php

use App\Http\Controllers\CompanyController;
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

Route::get('/company', function () {

});
Route::get('company/profile', [CompanyController::class, 'profile'])->name('companyProfile');
Route::get('company/profile/edit/{slug}', [CompanyController::class, 'edit'])->name('companyProfileEdit');
Route::put('company/profile/edit/{slug}', [CompanyController::class, 'updateProfile'])->name('companyProfileUpdate');
Route::patch('company/profile/editAvatar/{slug}', [CompanyController::class, 'updateAvatar'])->name('companyProfileEditAvatar');
Route::get('/districts/{province_id}', [CompanyController::class, 'getDistrictsByProvince']);
Route::get('/wards/{district_id}', [CompanyController::class, 'getWardsByDistrict']);
