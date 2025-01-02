<?php

use App\Http\Controllers\Clients\CompaniesController;
use App\Http\Controllers\Clients\HomeController;
use App\Http\Controllers\Clients\JobsController;
use App\Http\Controllers\Company\CollaborationsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Clients\UniversitiesController;
use App\Http\Controllers\Clients\WorkshopsController;

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

Route::middleware('web')->group(function () {
    Route::get('/',[HomeController::class, 'index'])->name('home');
    Route::get('doanh-nghiep', [CompaniesController::class, 'listCompanies'])->name('listCompany');
    Route::get('doanh-nghiep/{slug}', [CompaniesController::class, 'detailCompany'])->name('detailCompany');
    Route::get('change-language/{language}', [LanguageController::class, 'change'])->name('language.change');
    Route::get('truong-hoc', [UniversitiesController::class, 'listUniversities'])->name('listUniversity');
    Route::get('truong-hoc/{slug}', [UniversitiesController::class, 'showDetailUniversity'])->name('detailUniversity');
    Route::post('collaboration-store', [CollaborationsController::class, 'createRequest'])->name('collaborationStore');
    Route::get('viec-lam/{slug}', [JobsController::class, 'index'])->name('detailJob');
    Route::get('workshop', [HomeController::class, 'workshop'])->name('workshop');
    Route::get('chi-tiet-workshop/{slug}', [WorkshopsController::class, 'index'])->name('detailWorkShop');
    Route::get('viec-lam', [HomeController::class, 'search'])->name('search');
});
