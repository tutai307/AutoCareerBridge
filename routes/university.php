<?php

use App\Http\Controllers\University\ProfileController;
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

Route::get('unviersity', function () {
    echo "Dai hoc";
});

Route::get('university/profile', [ProfileController::class, 'show'])->name('profile');
Route::post('university/profile/upload-image', [ProfileController::class, 'uploadImage'])->name('profileUploadImage');
Route::post('university/profile',[ProfileController::class, 'update'])->name('profileUpdate');
