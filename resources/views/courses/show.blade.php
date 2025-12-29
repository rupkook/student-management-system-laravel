<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->title }} - Course Details</title>
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
                <a href="{{ route('courses.index') }}" class="block py-3 px-6 bg-gray-800 hover:bg-gray-700 transition">
                    <i class="fas fa-book mr-2"></i> Courses
                </a>
                <a href="{{ route('enrollments.index') }}" class="block py-3 px-6 hover:bg-gray-700 transition">
                    <i class="fas fa-clipboard-list mr-2"></i> Enrollments
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <header class="bg-white shadow-sm border-b">
                <div class="px-6 py-4">
                    <div class="flex items-center">
                        <a href="{{ route('courses.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h1 class="text-3xl font-bold text-gray-800">{{ $course->title }}</h1>
                    </div>
                </div>
            </header>

            <div class="p-6">
                <!-- Course Information Card -->
                <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $course->title }}</h2>
                            <p class="text-lg text-gray-600 mb-4">{{ $course->code }}</p>
                            <p class="text-gray-700">{{ $course->description }}</p>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('courses.edit', $course->id) }}" 
                               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                <i class="fas fa-edit mr-2"></i> Edit
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-clock text-blue-600 mr-2"></i>
                                <span class="text-sm font-medium text-gray-600">Credit Hours</span>
                            </div>
                            <p class="text-2xl font-bold text-gray-800">{{ $course->credit_hours }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-layer-group text-green-600 mr-2"></i>
                                <span class="text-sm font-medium text-gray-600">Level</span>
                            </div>
                            <p class="text-2xl font-bold text-gray-800 capitalize">{{ $course->level }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-toggle-on text-purple-600 mr-2"></i>
                                <span class="text-sm font-medium text-gray-600">Status</span>
                            </div>
                            <p class="text-2xl font-bold">
                                @if($course->is_active)
                                    <span class="text-green-600">Active</span>
                                @else
                                    <span class="text-red-600">Inactive</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Enrolled Students -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">Enrolled Students ({{ $enrollments->total() }})</h3>
                    </div>
                    
                    @if($enrollments->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Enrollment Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Grade</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($enrollments as $enrollment)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-6 py-4">
                                                @if($enrollment->student)
                                                    <div class="flex items-center">
                                                        <div class="bg-purple-100 rounded-full p-2 mr-3">
                                                            <i class="fas fa-user text-purple-600 text-xs"></i>
                                                        </div>
                                                        <div>
                                                            <p class="text-sm font-medium text-gray-900">{{ $enrollment->student->full_name }}</p>
                                                            <p class="text-xs text-gray-500">{{ $enrollment->student->email }}</p>
                                                        </div>
                                                    </div>
                                                @else
                                                    <p class="text-sm text-gray-500">Student not found</p>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                {{ $enrollment->student ? $enrollment->student->student_id : 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                {{ $enrollment->enrollment_date->format('M d, Y') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <span class="px-2 py-1 text-xs rounded-full 
                                                    @if($enrollment->status == 'active') bg-green-100 text-green-800
                                                    @elseif($enrollment->status == 'completed') bg-blue-100 text-blue-800
                                                    @elseif($enrollment->status == 'dropped') bg-gray-100 text-gray-800
                                                    @elseif($enrollment->status == 'failed') bg-red-100 text-red-800
                                                    @else bg-yellow-100 text-yellow-800 @endif">
                                                    {{ ucfirst($enrollment->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                @if($enrollment->status == 'completed' && $enrollment->grade)
                                                    {{ $enrollment->grade }}%
                                                @else
                                                    <span class="text-gray-400">
                                                        @if($enrollment->status == 'completed')
                                                            Not graded
                                                        @else
                                                            N/A
                                                        @endif
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="px-6 py-4 border-t border-gray-200">
                            {{ $enrollments->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-user-graduate text-gray-400 text-5xl mb-4"></i>
                            <p class="text-gray-500 text-lg">No students enrolled in this course yet.</p>
                            <a href="{{ route('enrollments.create') }}" 
                               class="mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                <i class="fas fa-plus mr-2"></i> Enroll Student
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
</body>
</html>
