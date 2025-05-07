<?php

use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ImageTextController;
use App\Http\Controllers\SchoolController;
use App\Livewire\Admin\Exercises;
use App\Livewire\Admin\Schools;
use App\Livewire\Admin\Users;
use App\Livewire\Teachers\Students;
use App\Livewire\Exercise\Play;
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
Route::get('exercises/{part}/play/{id}', Play::class)->name('exercises.play')->middleware(['auth']);
Route::post('exercises/finish', [ExerciseController::class, 'submit'])->name('finish')->middleware('auth');
Route::get('students', Students::class)->name('students')->middleware(middleware: ['auth']);

Route::get('admin/exercises', Exercises::class)->name('admin.exercises')->middleware(['auth']);
Route::get('admin/exercises/part{part}/{id}/edit', [ExerciseController::class, 'editExercise'])
    ->name('admin.exercises.edit')
    ->middleware(['auth']);
    Route::post('/extract-text', [ImageTextController::class, 'extractTextFromImage']);
    Route::get('admin/schools', Schools::class)->name('admin.schools')->middleware(['auth']);
Route::get('admin/users', Users::class)->name('admin.users')->middleware(['auth']);
require __DIR__ . '/auth.php';
