<?php

use App\Http\Controllers\Clients\CompaniesController;
use App\Http\Controllers\Clients\HomeController;
use App\Http\Controllers\Company\CollaborationsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Clients\UniversitiesController;

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

//Route::get('/', function () {
//    return 'CLIENT';
//});

Route::middleware('web')->group(function () {
    Route::get('/',[HomeController::class, 'index'])->name('home');
    Route::get('list-company', [CompaniesController::class, 'listCompanies'])->name('listCompany');
    Route::get('detail-company/{slug}', [CompaniesController::class, 'detailCompany'])->name('detailCompany');
    Route::get('change-language/{language}', [LanguageController::class, 'change'])->name('language.change');
    Route::get('list-university', [UniversitiesController::class, 'listUniversities'])->name('listUniversity');
    Route::get('detail-university/{slug}', [UniversitiesController::class, 'showDetailUniversity'])->name('detailUniversity');
    Route::post('collaboration-store', [CollaborationsController::class, 'createRequest'])->name('collaborationStore');
    Route::get('detail-workshop/{slug}', [UniversitiesController::class, 'detailWorkShop'])->name('detailWorkShop');
    Route::get('detail-job/{slug}',function (){
    return "<h1>Mình xin phép ăn miếng to nhé!😘😘😘😘😘</h1>";
    })->name('detailJob');
});
