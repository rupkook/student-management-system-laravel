<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Enrollment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white">
            <div class="p-6">
                <h2 class="text-2xl font-bold flex items-center">
                    <i class="fas fa-graduation-cap mr-2"></i>
                    Student Management
                </h2>
            </div>
            <nav class="mt-6">
                <a href="{{ route('dashboard') }}" class="block py-3 px-6 hover:bg-gray-700 transition">
                    <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                </a>
                <a href="{{ route('students.index') }}" class="block py-3 px-6 hover:bg-gray-700 transition">
                    <i class="fas fa-user-graduate mr-2"></i> Students
                </a>
                <a href="{{ route('courses.index') }}" class="block py-3 px-6 hover:bg-gray-700 transition">
                    <i class="fas fa-book mr-2"></i> Courses
                </a>
                <a href="{{ route('enrollments.index') }}" class="block py-3 px-6 bg-gray-800 hover:bg-gray-700 transition">
                    <i class="fas fa-clipboard-list mr-2"></i> Enrollments
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <header class="bg-white shadow-sm border-b">
                <div class="px-6 py-4">
                    <div class="flex items-center">
                        <a href="{{ route('enrollments.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h1 class="text-3xl font-bold text-gray-800">Add New Enrollment</h1>
                    </div>
                </div>
            </header>

            <div class="p-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <form action="{{ route('enrollments.store') }}" method="POST">
                        @csrf
                        
                        <!-- Enrollment Information -->
                        <div class="mb-8">
                            <h2 class="text-xl font-semibold mb-4 text-gray-800">Enrollment Details</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Student</label>
                                    <select name="student_id" required
                                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Select Student</option>
                                        @foreach($students as $student)
                                            <option value="{{ $student->id }}" 
                                                {{ old('student_id', request('student_id')) == $student->id ? 'selected' : '' }}>
                                                {{ $student->full_name }} ({{ $student->student_id }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('student_id')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Course</label>
                                    <select name="course_id" required id="course-select"
                                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            onchange="updateCourseInfo()">
                                        <option value="">Select Course</option>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}" 
                                                data-credits="{{ $course->credit_hours }}"
                                                data-code="{{ $course->code }}"
                                                {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                                {{ $course->title }} ({{ $course->code }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('course_id')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div id="course-info" class="hidden">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Course Information</label>
                                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <p class="text-xs text-blue-600 font-medium">Credit Hours</p>
                                                <p class="text-lg font-bold text-blue-800" id="credit-hours">-</p>
                                            </div>
                                            <div>
                                                <p class="text-xs text-blue-600 font-medium">Course Code</p>
                                                <p class="text-lg font-bold text-blue-800" id="course-code">-</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Enrollment Date</label>
                                    <input type="date" name="enrollment_date" required
                                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           value="{{ old('enrollment_date', date('Y-m-d')) }}">
                                    @error('enrollment_date')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                    <select name="status" required id="status-select"
                                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            onchange="toggleGradeInput()">
                                        <option value="">Select Status</option>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="dropped" {{ old('status') == 'dropped' ? 'selected' : '' }}>Dropped</option>
                                        <option value="failed" {{ old('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                                    </select>
                                    @error('status')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Grade (%)</label>
                                    <input type="number" name="grade" id="grade-input" min="0" max="100" step="0.01"
                                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           value="{{ old('grade') }}" placeholder="Optional">
                                    @error('grade')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                    <p class="text-sm text-gray-500 mt-1" id="grade-help">Grade can only be entered when status is "Completed"</p>
                                </div>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="mb-8">
                            <h2 class="text-xl font-semibold mb-4 text-gray-800">Additional Information</h2>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                                <textarea name="notes" rows="4"
                                          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          placeholder="Enter any additional notes...">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('enrollments.index') }}" 
                               class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                <i class="fas fa-save mr-2"></i> Save Enrollment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        function updateCourseInfo() {
            const courseSelect = document.getElementById('course-select');
            const courseInfo = document.getElementById('course-info');
            const creditHoursEl = document.getElementById('credit-hours');
            const courseCodeEl = document.getElementById('course-code');
            
            const selectedOption = courseSelect.options[courseSelect.selectedIndex];
            
            if (courseSelect.value && selectedOption && selectedOption.value !== "") {
                const credits = selectedOption.getAttribute('data-credits');
                const code = selectedOption.getAttribute('data-code');
                
                creditHoursEl.textContent = credits ? credits + ' credits' : 'N/A';
                courseCodeEl.textContent = code || 'N/A';
                
                courseInfo.classList.remove('hidden');
                courseInfo.classList.add('animate-fadeIn');
            } else {
                courseInfo.classList.add('hidden');
                creditHoursEl.textContent = '-';
                courseCodeEl.textContent = '-';
            }
        }
        
        function toggleGradeInput() {
            const statusSelect = document.getElementById('status-select');
            const gradeInput = document.getElementById('grade-input');
            const gradeHelp = document.getElementById('grade-help');
            
            if (statusSelect.value === 'completed') {
                gradeInput.disabled = false;
                gradeInput.classList.remove('bg-gray-100', 'text-gray-500');
                gradeInput.classList.add('bg-white', 'text-gray-900');
                gradeHelp.textContent = 'Enter grade for completed enrollment';
                gradeHelp.classList.remove('text-red-500');
                gradeHelp.classList.add('text-gray-500');
            } else {
                gradeInput.disabled = true;
                gradeInput.classList.remove('bg-white', 'text-gray-900');
                gradeInput.classList.add('bg-gray-100', 'text-gray-500');
                gradeHelp.textContent = 'Grade can only be entered when status is "Completed"';
                gradeHelp.classList.remove('text-gray-500');
                gradeHelp.classList.add('text-red-500');
                
                // Clear grade if status is not completed
                gradeInput.value = '';
            }
        }
        
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateCourseInfo();
            toggleGradeInput();
        });
        
        // Add fade-in animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(-10px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-fadeIn {
                animation: fadeIn 0.3s ease-out;
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
