<?php

use App\Http\Controllers\Admin\FieldsController;
use App\Http\Controllers\Company\CollaborationsController;
use App\Http\Controllers\Company\CompaniesController;
use App\Http\Controllers\Company\MajorsController as CompanyMajorsController;
use App\Http\Controllers\Location\LocationController;
use App\Http\Controllers\University\MajorsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('provinces', [LocationController::class, 'getProvinces']);
Route::get('districts/{provinceId}', [LocationController::class, 'getDistricts']);
Route::get('wards/{districtId}', [LocationController::class, 'getWards']);

Route::get('fields',[FieldsController::class, 'getAllFields']);
Route::get('majors',[MajorsController::class, 'getMajorsAll']);
Route::get('majorsAll',[MajorsController::class, 'getMajorsAll']);

Route::get('company-majors', [CompanyMajorsController::class, 'getAvailableMajorsForCompany']);

//Route::post('collaboration-store', [CollaborationsController::class, 'createRequest'])->name('collaborationStore');
