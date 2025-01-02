<?php

use App\Http\Controllers\University\JobsController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\University\CollaborationsController;
use App\Http\Controllers\University\ProfileController;
use App\Http\Controllers\University\AcademicAffairsController;
use App\Http\Controllers\University\MajorsController;
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

// Register university
Route::get('university/register', [ProfileController::class, 'register'])->name('university.register');
Route::post('university/register/{user_id}', [ProfileController::class, 'handleRegister'])->name('university.handleRegister');
// Update profile university
Route::get('university/profile', [ProfileController::class, 'show'])->name('university.profile');
Route::post('university/profile/upload-image', [ProfileController::class, 'uploadImage'])->name('university.profileUploadImage');
Route::post('university/profile/{id}', [ProfileController::class, 'update'])->name('univertsity.profileUpdate');

Route::get('detail-university-company/{slug}', [UniversitiesController::class, 'showDetailUniversity'])->name('detailUniversityAdmin');
Route::prefix('university')
    ->as('university.')
    ->middleware(['check.university', 'check.university.isEmpty'])
    ->group(function () {
        Route::get('/', [UniversitiesController::class, 'dashboard'])->name('home');
        Route::post('get-chart-workshop', [UniversitiesController::class, 'getChartWorkshop'])->name('getChartWorkshop');

        Route::resource('students', StudentsController::class);

        Route::post('students/import', [StudentsController::class, 'import'])->name('studentsImport');
        Route::get('students/download/template', [StudentsController::class, 'downloadTemplate'])->name('studentsDownloadTemplate');
        Route::post('students/export', [App\Http\Controllers\Export\StudentsController::class, 'export'])->name('studentsExport');

        //academic
        Route::get('academic-affairs', [AcademicAffairsController::class, 'index'])->name('academicAffairs');
        Route::get('academic-affairs/create', [AcademicAffairsController::class, 'create'])->name('createAcademicAffairs');
        Route::post('academic-affairs/store', [AcademicAffairsController::class, 'store'])->name('storeAcademicAffairs');
        Route::get('academic-affairs/edit/{id}', [AcademicAffairsController::class, 'edit'])->name('editAcademicAffairs');
        Route::put('academic-affairs/update/{userId}', [AcademicAffairsController::class, 'update'])->name('updateAcademicAffairs');
        Route::delete('academic-affairs/delete/{id}', [AcademicAffairsController::class, 'delete'])->name('deleteAcademicAffairs');

        Route::resource('workshop', WorkShopsController::class);

        Route::get('/jobs/applied', [JobsController::class, 'index'])->name('jobs.applied');
        Route::post('job/apply', [JobsController::class, 'apply'])->name('job.apply');
        Route::post('job/cancel-apply/{id}', [JobsController::class, 'cancelApply'])->name('job.cancelApply');
        Route::get('job-detail/{slug}', [JobsController::class, 'show'])->name('jobDetail');
        // Manage majors in university
        Route::resource('majors', MajorsController::class);

        Route::get('manage-collaboration', [CollaborationsController::class, 'index'])->name('collaboration');
        Route::post('colaboration/invite', [CollaborationsController::class, 'createRequest'])->name('collaboration.invite');
        Route::post('colaboration/change-status', [CollaborationsController::class, 'changeStatus'])->name('changeStatusColab');
        Route::delete('collaboration/delete/{id}', [CollaborationsController::class, 'delete'])->name('collaboration.delete');    Route::get('manage-university-job', [JobsController::class, 'manageUniversityJob'])->name('manageUniversityJob');
        Route::get('manage-company-workshop', [WorkShopsController::class, 'manageCompanyWorkshop'])->name('manageCompanyWorkshop');
        Route::get('manage-company-workshop/change-status/{companyId}/{workshopId}/{status}', [WorkShopsController::class, 'updateStatus'])->name('updateStatusWorkShop');

    });
