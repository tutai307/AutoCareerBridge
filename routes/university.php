<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\University\StudentsController;
use App\Http\Controllers\University\WorkShopsController;
use App\Http\Controllers\University\UniversitiesController;
use App\Http\Controllers\University\AcademicAffairsController;

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

Route::get('detail/{id}', [UniversitiesController::class, 'showDetailUniversity']);

Route::prefix('university')
    ->as('university.')
    ->middleware('check.university')
    ->group(function () {
        Route::get('/', function () {
            return view('management.pages.home');
        })->name('home');
        Route::resource('students', StudentsController::class);

        Route::post('students/import', [StudentsController::class, 'import'])->name('students.import');

        //academic
        Route::get('academicAffairs', [AcademicAffairsController::class, 'index'])->name('academicAffairs');
        Route::get('academicAffairs/create', [AcademicAffairsController::class, 'create'])->name('createAcademicAffairs');
        Route::post('academicAffairs/store', [AcademicAffairsController::class, 'store'])->name('storeAcademicAffairs');
        Route::get('academicAffairs/edit/{id}', [AcademicAffairsController::class, 'edit'])->name('editAcademicAffairs');
        Route::put('academicAffairs/update/{userId}', [AcademicAffairsController::class, 'update'])->name('updateAcademicAffairs');
        Route::delete('academicAffairs/delete/{id}', [AcademicAffairsController::class, 'delete'])->name('deleteAcademicAffairs');

        Route::resource('workshop', WorkShopsController::class);
    });
