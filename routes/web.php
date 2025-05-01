<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $courseCount = Course::count();
    $lessonCount = Lesson::count();
    $userCount = User::count();
    return view('dashboard', compact('courseCount', 'lessonCount', 'userCount'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'enroll'])->name('courses.enroll');
    Route::get('/user/enrolled-courses', [EnrollmentController::class, 'getUserEnrolledCourses'])->name('enrollments.my-courses');
});
Route::get('lessons', [LessonController::class, 'index'])->name('lessons.index');
Route::get('courses', [CourseController::class, 'index'])->name('courses.index');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('lessons' , LessonController::class)->except(['index']);
    Route::resource('courses', CourseController::class)->except(['index']);    
});

require __DIR__.'/auth.php';
