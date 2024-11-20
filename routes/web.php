<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\LanguageController;

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
    Route::get('/', function () {
        return view('client.pages.home');
    })->name('home');

    Route::group(['prefix' => 'listCompany', 'as' => 'listCompany.'], function () {
        Route::get('/', function () {
            return view('client.pages.company.listCompany');
        })->name('listCompany');
    });
    Route::get('change-language/{language}', [LanguageController::class, 'change'])->name('language.change');
});

