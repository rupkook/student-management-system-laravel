<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use Illuminate\Support\Facades\Route;

// Main route - redirect to student management dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Student Management Routes
Route::resource('students', StudentController::class);
Route::get('/students/{student}/courses', [StudentController::class, 'courses'])->name('students.courses');

// Course Management Routes
Route::resource('courses', CourseController::class);

// Enrollment Management Routes
Route::resource('enrollments', EnrollmentController::class);
