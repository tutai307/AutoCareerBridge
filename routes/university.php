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

Route::get('university', function () {
    echo "Dai hoc";
});

Route::get('detail/{id}',[UniversitiesController::class, 'showDetailUniversity']);

Route::prefix('university')
    ->as('university.')
    ->group(function () {
        Route::resource('students', StudentsController::class);
    });

