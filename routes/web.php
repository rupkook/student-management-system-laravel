<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\SplashController;
use Illuminate\Support\Facades\Route;

// Splash screen route
Route::get('/', [SplashController::class, 'index'])->name('splash');

// Dashboard route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Student Management Routes
Route::resource('students', StudentController::class);
Route::get('/students/{student}/courses', [StudentController::class, 'courses'])->name('students.courses');

// Course Management Routes
Route::resource('courses', CourseController::class);

// Enrollment Management Routes
Route::resource('enrollments', EnrollmentController::class);
