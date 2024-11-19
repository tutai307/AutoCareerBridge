<?php


use App\Http\Controllers\University\UniversitiesController;
use App\Http\Controllers\University\StudentsController;
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

Route::get('detail/{id}',[UniversitiesController::class, 'showDetailUniversity']);

Route::prefix('university')
    ->as('university.')
    ->middleware('check.university')
    ->group(function () {
    Route::get('/', function () {
        return view('management.pages.home');
    })->name('home');
        Route::resource('students', StudentsController::class);
    });


