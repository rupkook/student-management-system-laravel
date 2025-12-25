<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
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
                <a href="{{ route('students.index') }}" class="block py-3 px-6 bg-gray-800 hover:bg-gray-700 transition">
                    <i class="fas fa-user-graduate mr-2"></i> Students
                </a>
                <a href="{{ route('courses.index') }}" class="block py-3 px-6 hover:bg-gray-700 transition">
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
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <a href="{{ route('students.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                            <h1 class="text-3xl font-bold text-gray-800">Student Details</h1>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('students.edit', $student) }}" 
                               class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                                <i class="fas fa-edit mr-2"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <div class="p-6">
                <!-- Student Profile Card -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            @if($student->photo)
                                <img class="h-32 w-32 rounded-full" src="{{ asset('storage/'.$student->photo) }}" alt="{{ $student->full_name }}">
                            @else
                                <div class="h-32 w-32 rounded-full bg-gray-300 flex items-center justify-center">
                                    <i class="fas fa-user text-gray-600 text-4xl"></i>
                                </div>
                            @endif
                        </div>
                        <div class="ml-6 flex-1">
                            <h2 class="text-2xl font-bold text-gray-900">{{ $student->full_name }}</h2>
                            <p class="text-gray-600 mt-1">Student ID: {{ $student->student_id }}</p>
                            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">Email</p>
                                    <p class="font-medium">{{ $student->email }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Phone</p>
                                    <p class="font-medium">{{ $student->phone ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Age</p>
                                    <p class="font-medium">{{ $student->age }} years old</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Gender</p>
                                    <p class="font-medium">{{ ucfirst($student->gender) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Admission Date</p>
                                    <p class="font-medium">{{ $student->admission_date->format('M d, Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Status</p>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($student->status == 'active') bg-green-100 text-green-800
                                        @elseif($student->status == 'inactive') bg-gray-100 text-gray-800
                                        @elseif($student->status == 'suspended') bg-red-100 text-red-800
                                        @else bg-blue-100 text-blue-800 @endif">
                                        {{ ucfirst($student->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Address Information -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h3 class="text-lg font-semibold mb-4">Address Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Address</p>
                            <p class="font-medium">{{ $student->address }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">City</p>
                            <p class="font-medium">{{ $student->city }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">State</p>
                            <p class="font-medium">{{ $student->state }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Country</p>
                            <p class="font-medium">{{ $student->country }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Zip Code</p>
                            <p class="font-medium">{{ $student->zip_code }}</p>
                        </div>
                    </div>
                </div>

                <!-- Parent Information -->
                @if($student->parent_name || $student->parent_phone)
                    <div class="bg-white rounded-lg shadow p-6 mb-6">
                        <h3 class="text-lg font-semibold mb-4">Parent Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($student->parent_name)
                                <div>
                                    <p class="text-sm text-gray-500">Parent Name</p>
                                    <p class="font-medium">{{ $student->parent_name }}</p>
                                </div>
                            @endif
                            @if($student->parent_phone)
                                <div>
                                    <p class="text-sm text-gray-500">Parent Phone</p>
                                    <p class="font-medium">{{ $student->parent_phone }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Course Enrollments -->
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Course Enrollments</h3>
                        <a href="{{ route('enrollments.create') }}?student_id={{ $student->id }}" 
                           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm">
                            <i class="fas fa-plus mr-2"></i> Add Course
                        </a>
                    </div>
                    @if($student->enrollments->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Course</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Enrollment Date</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Grade</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($student->enrollments as $enrollment)
                                        <tr>
                                            <td class="px-4 py-3">
                                                <div>
                                                    <p class="font-medium">{{ $enrollment->course->title }}</p>
                                                    <p class="text-sm text-gray-500">{{ $enrollment->course->code }}</p>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-sm">{{ $enrollment->enrollment_date->format('M d, Y') }}</td>
                                            <td class="px-4 py-3">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    @if($enrollment->status == 'active') bg-green-100 text-green-800
                                                    @elseif($enrollment->status == 'completed') bg-blue-100 text-blue-800
                                                    @elseif($enrollment->status == 'dropped') bg-gray-100 text-gray-800
                                                    @else bg-red-100 text-red-800 @endif">
                                                    {{ ucfirst($enrollment->status) }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3">
                                                @if($enrollment->grade)
                                                    <span class="font-medium">{{ $enrollment->grade }}%</span>
                                                    <span class="text-sm text-gray-500 ml-1">({{ $enrollment->grade_letter }})</span>
                                                @else
                                                    <span class="text-gray-400">N/A</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                <a href="{{ route('enrollments.edit', $enrollment) }}" class="text-indigo-600 hover:text-indigo-900">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-book-open text-4xl mb-2"></i>
                            <p>No course enrollments found.</p>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
</body>
</html>
