<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Student;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Support\Str;

// Add Students
$students = [
    [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'gender' => 'male',
        'city' => 'Dhaka',
        'state' => 'Dhaka',
        'zip_code' => '1000',
        'country' => 'Bangladesh',
        'parent_name' => 'Richard Doe',
        'parent_phone' => '01712345679'
    ],
    [
        'first_name' => 'Jane',
        'last_name' => 'Smith',
        'gender' => 'female',
        'city' => 'Chittagong',
        'state' => 'Chittagong',
        'zip_code' => '4000',
        'country' => 'Bangladesh',
        'parent_name' => 'Robert Smith',
        'parent_phone' => '01812345678'
    ],
    [
        'first_name' => 'Muhammad',
        'last_name' => 'Rahman',
        'gender' => 'male',
        'city' => 'Sylhet',
        'state' => 'Sylhet',
        'zip_code' => '3100',
        'country' => 'Bangladesh',
        'parent_name' => 'Abdul Rahman',
        'parent_phone' => '01912345677'
    ],
    [
        'first_name' => 'Fatima',
        'last_name' => 'Khan',
        'gender' => 'female',
        'city' => 'Rajshahi',
        'state' => 'Rajshahi',
        'zip_code' => '6000',
        'country' => 'Bangladesh',
        'parent_name' => 'Ahmed Khan',
        'parent_phone' => '01612345676'
    ],
    [
        'first_name' => 'David',
        'last_name' => 'Wilson',
        'gender' => 'male',
        'city' => 'Khulna',
        'state' => 'Khulna',
        'zip_code' => '9000',
        'country' => 'Bangladesh',
        'parent_name' => 'Michael Wilson',
        'parent_phone' => '01512345675'
    ]
];

echo "Adding Students...\n";
$lastStudent = Student::orderBy('id', 'desc')->first();
$lastNumber = $lastStudent ? (int)substr($lastStudent->student_id, 3) : 0;

foreach ($students as $index => $studentData) {
    $student = new Student();
    $nextNumber = $lastNumber + $index + 1;
    $student->student_id = 'STD' . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
    $student->first_name = $studentData['first_name'];
    $student->last_name = $studentData['last_name'];
    $student->email = strtolower($studentData['first_name'] . '.' . $studentData['last_name']) . time() . '@example.com';
    $student->phone = '01' . rand(100000000, 999999999);
    $student->date_of_birth = '200' . rand(0, 2) . '-' . str_pad(rand(1, 12), 2, '0', STR_PAD_LEFT) . '-' . str_pad(rand(1, 28), 2, '0', STR_PAD_LEFT);
    $student->gender = $studentData['gender'];
    $student->address = rand(100, 999) . ' Main Street';
    $student->city = $studentData['city'];
    $student->state = $studentData['state'];
    $student->zip_code = $studentData['zip_code'];
    $student->country = $studentData['country'];
    $student->parent_name = $studentData['parent_name'];
    $student->parent_phone = $studentData['parent_phone'];
    $student->admission_date = now();
    $student->status = 'active';
    $student->save();
    
    echo "Student added: {$student->first_name} {$student->last_name} (ID: {$student->student_id})\n";
}

// Add Courses
$courses = [
    [
        'code' => 'CS101',
        'title' => 'Introduction to Computer Science',
        'description' => 'Basic concepts of computer science and programming fundamentals',
        'credit_hours' => 3,
        'level' => 'beginner'
    ],
    [
        'code' => 'MATH201',
        'title' => 'Advanced Mathematics',
        'description' => 'Calculus, linear algebra, and differential equations',
        'credit_hours' => 4,
        'level' => 'intermediate'
    ],
    [
        'code' => 'ENG301',
        'title' => 'Business English',
        'description' => 'Professional communication and business writing skills',
        'credit_hours' => 3,
        'level' => 'intermediate'
    ],
    [
        'code' => 'PHY102',
        'title' => 'Physics Fundamentals',
        'description' => 'Introduction to mechanics, thermodynamics, and electromagnetism',
        'credit_hours' => 4,
        'level' => 'beginner'
    ],
    [
        'code' => 'BIO201',
        'title' => 'Biology and Life Sciences',
        'description' => 'Cell biology, genetics, and evolution',
        'credit_hours' => 3,
        'level' => 'intermediate'
    ]
];

echo "\nAdding Courses...\n";
foreach ($courses as $courseData) {
    $existingCourse = Course::where('code', $courseData['code'])->first();
    if (!$existingCourse) {
        $course = new Course();
        $course->code = $courseData['code'];
        $course->title = $courseData['title'];
        $course->description = $courseData['description'];
        $course->credit_hours = $courseData['credit_hours'];
        $course->level = $courseData['level'];
        $course->is_active = true;
        $course->save();
        
        echo "Course added: {$course->code} - {$course->title}\n";
    } else {
        echo "Course already exists: {$existingCourse->code} - {$existingCourse->title}\n";
    }
}

// Add some enrollments - each student can enroll in only ONE course
echo "\nAdding Enrollments...\n";
$allStudents = Student::all();
$allCourses = Course::all();

foreach ($allStudents as $student) {
    // Check if student already has an enrollment
    $existingEnrollment = Enrollment::where('student_id', $student->id)->first();
    
    if (!$existingEnrollment) {
        // Enroll each student in exactly ONE random course
        $selectedCourse = $allCourses->random();
        
        $enrollment = new Enrollment();
        $enrollment->student_id = $student->id;
        $enrollment->course_id = $selectedCourse->id;
        $enrollment->enrollment_date = now()->subDays(rand(1, 30));
        $enrollment->status = 'active';
        $enrollment->grade = rand(65, 95);
        $enrollment->save();
        
        echo "Enrolled: {$student->first_name} {$student->last_name} in {$selectedCourse->title}\n";
    } else {
        echo "Student {$student->first_name} {$student->last_name} already enrolled in a course\n";
    }
}

echo "\n=== Summary ===\n";
echo "Total Students: " . Student::count() . "\n";
echo "Total Courses: " . Course::count() . "\n";
echo "Total Enrollments: " . Enrollment::count() . "\n";
