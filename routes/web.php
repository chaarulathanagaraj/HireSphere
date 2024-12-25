<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequirementController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\HiringController;


Route::get('/hiring-details', [HiringController::class, 'index'])->name('hiring.details');
Route::get('/hired', [HiringController::class, 'hired'])->name('hiredhr.details');


Route::get('/hiring-details-form/{id}', [HiringController::class, 'hiringDetailsForm'])->name('hiringDetailsForm');
Route::post('/submit-hiring-details', [HiringController::class, 'submitHiringDetails'])->name('submitHiringDetails');

Route::get('/requests', [RequirementController::class, 'requests'])->name('requests');
Route::get('/req_details', [RequirementController::class, 'reqDetails'])->name('req_details');
Route::patch('/requests/{id}', [RequirementController::class, 'updateRequestStatus'])->name('requests.update');
Route::delete('/req_details/{id}', [RequirementController::class, 'destroy'])->name('req_details.destroy');



Route::post('/submit', [RequirementController::class, 'submit']);
Route::get('/requirement-form', function () {
    $teams = \App\Models\User::select('name')->distinct()->pluck('name');
    $roles = \App\Models\Role::select('rolename')->distinct()->pluck('rolename');
    return view('requirement_form', compact('teams', 'roles'));
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
