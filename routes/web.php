<?php

use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\SchoolController;
use App\Livewire\Teachers\Students;
use App\Models\School;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;


Route::view('/', 'welcome');
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('exercises', 'exercises.exercises')
    ->middleware(['auth'])
    ->name('exercises');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('exercises/{part}', [ExerciseController::class, 'getIndex'])->name('exercises.part')->middleware(['auth']);

Route::get('myschool', Students::class)->name('myschool')->middleware(middleware: ['auth']);

require __DIR__ . '/auth.php';
