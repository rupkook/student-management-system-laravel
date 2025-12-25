<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistics
        $totalStudents = Student::count();
        $activeStudents = Student::where('status', 'active')->count();
        $totalCourses = Course::where('is_active', true)->count();
        $totalEnrollments = Enrollment::where('status', 'active')->count();
        $recentEnrollments = Enrollment::with(['student', 'course'])
            ->whereHas('student')
            ->whereHas('course')
            ->latest()
            ->take(5)
            ->get();
        
        // Charts data
        $studentsByStatus = Student::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
        
        $enrollmentsByMonth = Enrollment::selectRaw('DATE_FORMAT(enrollment_date, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->take(12)
            ->pluck('count', 'month')
            ->toArray();
        
        $coursesByLevel = Course::selectRaw('level, COUNT(*) as count')
            ->where('is_active', true)
            ->groupBy('level')
            ->pluck('count', 'level')
            ->toArray();
        
        // Recent activities
        $recentStudents = Student::latest()->take(3)->get();
        $recentCourses = Course::latest()->take(3)->get();
        
        // Top performing students
        $topStudents = Student::with(['enrollments' => function($query) {
                $query->where('grade', '>=', 80);
            }])
            ->whereHas('enrollments', function($query) {
                $query->where('grade', '>=', 80);
            })
            ->withCount(['enrollments as average_grade' => function($query) {
                $query->select(\DB::raw('avg(grade)'));
            }])
            ->orderByDesc('average_grade')
            ->take(5)
            ->get();
        
        // Popular courses
        $popularCourses = Course::withCount('enrollments')
            ->where('is_active', true)
            ->orderByDesc('enrollments_count')
            ->take(5)
            ->get();
        
        return view('dashboard.index', compact(
            'totalStudents',
            'activeStudents',
            'totalCourses',
            'totalEnrollments',
            'recentEnrollments',
            'studentsByStatus',
            'enrollmentsByMonth',
            'coursesByLevel',
            'recentStudents',
            'recentCourses',
            'topStudents',
            'popularCourses'
        ));
    }
}
