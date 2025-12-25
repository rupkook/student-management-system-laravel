<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StudentManagementSeeder extends Seeder
{
    public function run()
    {
        // Create sample courses
        $courses = [
            [
                'code' => 'CS101',
                'title' => 'Introduction to Computer Science',
                'description' => 'Fundamentals of computer science, programming concepts, and problem-solving techniques.',
                'credit_hours' => 3,
                'level' => 'beginner',
                'is_active' => true,
            ],
            [
                'code' => 'CS201',
                'title' => 'Data Structures and Algorithms',
                'description' => 'Advanced programming concepts including arrays, linked lists, trees, and graph algorithms.',
                'credit_hours' => 4,
                'level' => 'intermediate',
                'is_active' => true,
            ],
            [
                'code' => 'CS301',
                'title' => 'Database Management Systems',
                'description' => 'Database design, SQL, and database administration concepts.',
                'credit_hours' => 3,
                'level' => 'intermediate',
                'is_active' => true,
            ],
            [
                'code' => 'CS401',
                'title' => 'Machine Learning Fundamentals',
                'description' => 'Introduction to machine learning algorithms and applications.',
                'credit_hours' => 4,
                'level' => 'advanced',
                'is_active' => true,
            ],
            [
                'code' => 'MATH101',
                'title' => 'Calculus I',
                'description' => 'Differential and integral calculus fundamentals.',
                'credit_hours' => 4,
                'level' => 'beginner',
                'is_active' => true,
            ],
            [
                'code' => 'ENG101',
                'title' => 'English Composition',
                'description' => 'Academic writing and communication skills.',
                'credit_hours' => 3,
                'level' => 'beginner',
                'is_active' => true,
            ],
            [
                'code' => 'PHY101',
                'title' => 'Physics I',
                'description' => 'Introduction to mechanics, thermodynamics, and waves.',
                'credit_hours' => 4,
                'level' => 'beginner',
                'is_active' => true,
            ],
            [
                'code' => 'CHEM101',
                'title' => 'General Chemistry',
                'description' => 'Fundamentals of chemical principles and reactions.',
                'credit_hours' => 3,
                'level' => 'beginner',
                'is_active' => true,
            ],
        ];

        foreach ($courses as $courseData) {
            Course::create($courseData);
        }

        // Create sample students
        $firstNames = ['John', 'Jane', 'Michael', 'Sarah', 'David', 'Emily', 'Robert', 'Lisa', 'James', 'Mary', 
                       'William', 'Jennifer', 'Richard', 'Linda', 'Joseph', 'Patricia', 'Thomas', 'Barbara', 'Charles', 'Susan'];
        $lastNames = ['Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Garcia', 'Miller', 'Davis', 'Rodriguez', 'Martinez',
                      'Wilson', 'Anderson', 'Taylor', 'Thomas', 'Moore', 'Jackson', 'Martin', 'Lee', 'Thompson', 'White'];
        
        $cities = ['New York', 'Los Angeles', 'Chicago', 'Houston', 'Phoenix', 'Philadelphia', 'San Antonio', 'San Diego',
                  'Dallas', 'San Jose', 'Austin', 'Jacksonville', 'Fort Worth', 'Columbus', 'Charlotte'];
        $states = ['NY', 'CA', 'IL', 'TX', 'AZ', 'PA', 'TX', 'CA', 'TX', 'CA', 'TX', 'FL', 'TX', 'OH', 'NC'];
        $countries = ['USA', 'USA', 'USA', 'USA', 'USA', 'USA', 'USA', 'USA', 'USA', 'USA', 'USA', 'USA', 'USA', 'USA', 'USA'];

        for ($i = 0; $i < 30; $i++) {
            $firstName = $firstNames[array_rand($firstNames)];
            $lastName = $lastNames[array_rand($lastNames)];
            $cityIndex = array_rand($cities);
            
            $student = Student::create([
                'student_id' => 'STD' . strtoupper(Str::random(8)),
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => strtolower($firstName . '.' . $lastName . $i) . '@university.edu',
                'phone' => '555-' . rand(100, 999) . '-' . rand(1000, 9999),
                'date_of_birth' => now()->subYears(rand(18, 25))->subDays(rand(0, 365)),
                'gender' => ['male', 'female'][rand(0, 1)],
                'address' => rand(100, 9999) . ' University Ave',
                'city' => $cities[$cityIndex],
                'state' => $states[$cityIndex],
                'zip_code' => str_pad(rand(10000, 99999), 5, '0', STR_PAD_LEFT),
                'country' => $countries[$cityIndex],
                'parent_name' => rand(0, 1) ? 'Parent ' . $lastName : null,
                'parent_phone' => rand(0, 1) ? '555-' . rand(100, 999) . '-' . rand(1000, 9999) : null,
                'admission_date' => now()->subYears(rand(1, 4))->subDays(rand(0, 365)),
                'status' => ['active', 'active', 'active', 'inactive', 'graduated'][rand(0, 4)],
            ]);
        }

        // Create sample enrollments
        $students = Student::where('status', 'active')->get();
        $courses = Course::where('is_active', true)->get();
        
        foreach ($students as $student) {
            // Each student takes 3-6 courses
            $numCourses = rand(3, 6);
            $selectedCourses = $courses->random(min($numCourses, $courses->count()));
            
            foreach ($selectedCourses as $course) {
                // Check if enrollment already exists
                $existing = Enrollment::where('student_id', $student->id)
                    ->where('course_id', $course->id)
                    ->first();
                
                if (!$existing) {
                    $status = ['active', 'active', 'active', 'completed'][rand(0, 3)];
                    $grade = null;
                    
                    if ($status === 'completed') {
                        $grade = rand(65, 95) + (rand(0, 99) / 100);
                    }
                    
                    Enrollment::create([
                        'student_id' => $student->id,
                        'course_id' => $course->id,
                        'enrollment_date' => now()->subMonths(rand(1, 12)),
                        'status' => $status,
                        'grade' => $grade,
                        'notes' => rand(0, 1) ? 'Student showing good progress' : null,
                    ]);
                }
            }
        }

        $this->command->info('Student management system seeded successfully!');
        $this->command->info('Created ' . Course::count() . ' courses');
        $this->command->info('Created ' . Student::count() . ' students');
        $this->command->info('Created ' . Enrollment::count() . ' enrollments');
    }
}
