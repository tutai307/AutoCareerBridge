<?php

use App\Http\Controllers\University\ProfileController;
use App\Http\Controllers\University\AcademicAffairsController;
use App\Http\Controllers\University\StudentsController;
use App\Http\Controllers\University\UniversitiesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\University\WorkShopsController;

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

Route::get('unviersity', function () {
    echo "Dai hoc";
});
Route::get('university/register', [ProfileController::class, 'register'])->name('university.register');
Route::post('university/register/{id}', [ProfileController::class, 'handleRegister'])->name('university.handleRegister');

Route::get('university/profile', [ProfileController::class, 'show'])->name('university.profile');
Route::post('university/profile/upload-image', [ProfileController::class, 'uploadImage'])->name('university.profileUploadImage');
Route::post('university/profile/{id}',[ProfileController::class, 'update'])->name('univertsity.profileUpdate');
Route::get('detail-university/{id}', [UniversitiesController::class, 'showDetailUniversity'])->name('detailUniversity');

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
        Route::get('academic-affairs', [AcademicAffairsController::class, 'index'])->name('academicAffairs');
        Route::get('academic-affairs/create', [AcademicAffairsController::class, 'create'])->name('createAcademicAffairs');
        Route::post('academic-affairs/store', [AcademicAffairsController::class, 'store'])->name('storeAcademicAffairs');
        Route::get('academic-affairs/edit/{id}', [AcademicAffairsController::class, 'edit'])->name('editAcademicAffairs');
        Route::put('academic-affairs/update/{userId}', [AcademicAffairsController::class, 'update'])->name('updateAcademicAffairs');
        Route::delete('academic-affairs/delete/{id}', [AcademicAffairsController::class, 'delete'])->name('deleteAcademicAffairs');

        Route::resource('workshop', WorkShopsController::class);
    });
