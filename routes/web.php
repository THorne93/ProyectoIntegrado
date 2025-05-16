<?php

use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ImageTextController;
use App\Http\Controllers\SchoolController;
use App\Livewire\Admin\Exercises;
use App\Livewire\Statistics;
use App\Livewire\Admin\Schools;
use App\Livewire\Admin\Users;
use App\Livewire\Teachers\Students;
use App\Livewire\Exercise\Play;
use App\Http\Middleware\IsTeacher;
use App\Http\Middleware\IsAdmin;
use App\Models\School;
use Livewire\Livewire;

use App\Livewire\DashboardTeacher;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;


//General stuff

Route::fallback(function () {
  return redirect()->route('dashboard')->with('msg', 'That page does not exist');
});
Route::view('/', 'welcome');
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'Teacher') {
        return redirect()->route('dashboard.teacher');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


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
Route::get('statistics/pdf', [Statistics::class, 'printPDF'])->name('statistics.pdf')->middleware(['auth']);
Route::get('statistics', Statistics::class)->name('statistics')->middleware(['auth']);

//Teacher stuff


Route::get('/dashboard-teacher', DashboardTeacher::class)
    ->middleware(['auth', 'verified', IsTeacher::class])
    ->name('dashboard.teacher');
Route::view('school', 'school')
    ->middleware(['auth', IsTeacher::class])
    ->name('school');
Route::get('students', Students::class)->name('students')->middleware(middleware: ['auth', IsTeacher::class]);


//Admin stuff
Route::post('/extract-text', [ImageTextController::class, 'extractTextFromImage'])->middleware(['auth', IsAdmin::class]);
Route::get('/statistics/pdf/{id}', [Statistics::class, 'printPDFAdmin'])->name('statistics.print.admin')->middleware(['auth', IsAdmin::class]);
Route::get('admin/exercises', Exercises::class)->name('admin.exercises')->middleware(['auth', IsAdmin::class]);
Route::get('admin/exercises/part{part}/create', [ExerciseController::class, 'create'])->name('admin.exercises.create')->middleware(['auth', IsAdmin::class]);
Route::post('admin/exercises/part{part}/create', [ExerciseController::class, 'submit'])->name('admin.exercises.create')->middleware(['auth', IsAdmin::class]);
Route::get('admin/exercises/part{part}/{id}/edit', [ExerciseController::class, 'editExercise'])->name('admin.exercises.edit')->middleware(['auth', IsAdmin::class]);
Route::post('admin/exercises/part{part}/{id}/edit', [ExerciseController::class, 'updateExercise'])->name('admin.exercises.edit')->middleware(['auth', IsAdmin::class]);
Route::get('admin/schools', Schools::class)->name('admin.schools')->middleware(['auth', IsAdmin::class]);
Route::get('admin/users', Users::class)->name('admin.users')->middleware(['auth', IsAdmin::class]);


require __DIR__ . '/auth.php';
