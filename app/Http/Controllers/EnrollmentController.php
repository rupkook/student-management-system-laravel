<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with(['student', 'course'])
            ->whereHas('student')
            ->whereHas('course')
            ->latest()
            ->paginate(10);
        return view('enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        $students = Student::where('status', 'active')->get();
        $courses = Course::where('is_active', true)->get();
        return view('enrollments.create', compact('students', 'courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'enrollment_date' => 'required|date',
            'status' => 'required|in:active,completed,dropped,failed',
            'grade' => 'nullable|numeric|min:0|max:100',
            'notes' => 'nullable|string',
        ]);

        // Check if enrollment already exists
        $existing = Enrollment::where('student_id', $validated['student_id'])
            ->where('course_id', $validated['course_id'])
            ->first();

        if ($existing) {
            return redirect()->back()
                ->with('error', 'Student is already enrolled in this course.')
                ->withInput();
        }

        Enrollment::create($validated);

        return redirect()->route('enrollments.index')
            ->with('success', 'Enrollment created successfully.');
    }

    public function show(Enrollment $enrollment)
    {
        return view('enrollments.show', compact('enrollment'));
    }

    public function edit(Enrollment $enrollment)
    {
        $students = Student::where('status', 'active')->get();
        $courses = Course::where('is_active', true)->get();
        return view('enrollments.edit', compact('enrollment', 'students', 'courses'));
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'enrollment_date' => 'required|date',
            'status' => 'required|in:active,completed,dropped,failed',
            'grade' => 'nullable|numeric|min:0|max:100',
            'notes' => 'nullable|string',
        ]);

        $enrollment->update($validated);

        return redirect()->route('enrollments.index')
            ->with('success', 'Enrollment updated successfully.');
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();

        return redirect()->route('enrollments.index')
            ->with('success', 'Enrollment deleted successfully.');
    }
}
