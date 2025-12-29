<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Student;
use App\Models\Course;
use App\Models\Enrollment;

echo "Cleaning up unnecessary data...\n\n";

// Get all students
$allStudents = Student::all();

echo "Current Students:\n";
foreach ($allStudents as $student) {
    echo "- {$student->student_id}: {$student->first_name} {$student->last_name}\n";
}

// Keep only first 5 students (STD01-STD05) and delete the rest
$studentsToDelete = Student::whereNotIn('student_id', ['STD01', 'STD02', 'STD03', 'STD04', 'STD05'])->get();

echo "\nDeleting unnecessary students:\n";
foreach ($studentsToDelete as $student) {
    echo "Deleting: {$student->student_id} - {$student->first_name} {$student->last_name}\n";
    
    // Delete their enrollments first
    Enrollment::where('student_id', $student->id)->delete();
    
    // Delete the student
    $student->delete();
}

// Delete all enrollments and recreate clean ones for remaining students
echo "\nCleaning up enrollments...\n";
Enrollment::truncate();

// Keep only first 3 courses
$coursesToKeep = ['CS101', 'MATH201', 'ENG301'];
$coursesToDelete = Course::whereNotIn('code', $coursesToKeep)->get();

echo "\nDeleting unnecessary courses:\n";
foreach ($coursesToDelete as $course) {
    echo "Deleting: {$course->code} - {$course->title}\n";
    $course->delete();
}

// Create clean enrollments - each student gets exactly ONE course
$remainingStudents = Student::whereIn('student_id', ['STD01', 'STD02', 'STD03', 'STD04', 'STD05'])->get();
$remainingCourses = Course::whereIn('code', $coursesToKeep)->get();

echo "\nCreating clean enrollments (1 per student):\n";
foreach ($remainingStudents as $index => $student) {
    $course = $remainingCourses[$index % $remainingCourses->count()];
    
    $enrollment = new Enrollment();
    $enrollment->student_id = $student->id;
    $enrollment->course_id = $course->id;
    $enrollment->enrollment_date = now()->subDays(rand(1, 30));
    $enrollment->status = 'active';
    $enrollment->grade = rand(65, 95);
    $enrollment->save();
    
    echo "Enrolled: {$student->first_name} {$student->last_name} in {$course->title}\n";
}

echo "\n=== Final Summary ===\n";
echo "Total Students: " . Student::count() . "\n";
echo "Total Courses: " . Course::count() . "\n";
echo "Total Enrollments: " . Enrollment::count() . "\n";

echo "\nRemaining Students:\n";
foreach (Student::all() as $student) {
    echo "- {$student->student_id}: {$student->first_name} {$student->last_name}\n";
}

echo "\nRemaining Courses:\n";
foreach (Course::all() as $course) {
    echo "- {$course->code}: {$course->title}\n";
}
