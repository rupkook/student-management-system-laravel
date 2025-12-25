<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Details</title>
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
                        <h1 class="text-3xl font-bold text-gray-800">Enrollment Details</h1>
                    </div>
                </div>
            </header>

            <div class="p-6">
                <!-- Enrollment Info Card -->
                <div class="bg-white rounded-lg shadow-lg mb-6">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-semibold text-gray-800">Enrollment Information</h2>
                            <div class="flex space-x-2">
                                <a href="{{ route('enrollments.edit', $enrollment->id) }}" 
                                   class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                    <i class="fas fa-edit mr-2"></i> Edit
                                </a>
                                <form action="{{ route('enrollments.destroy', $enrollment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this enrollment?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                        <i class="fas fa-trash mr-2"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Student Info -->
                            <div class="border rounded-lg p-4">
                                <h3 class="font-semibold text-gray-700 mb-3">Student Information</h3>
                                @if($enrollment->student)
                                    <div class="flex items-center mb-3">
                                        @if($enrollment->student->photo)
                                            <img class="h-12 w-12 rounded-full object-cover mr-3" src="{{ asset('storage/'.$enrollment->student->photo) }}" alt="{{ $enrollment->student->full_name }}">
                                        @else
                                            <div class="h-12 w-12 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                                                <i class="fas fa-user text-purple-600"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $enrollment->student->full_name }}</p>
                                            <p class="text-sm text-gray-500">{{ $enrollment->student->student_id }}</p>
                                        </div>
                                    </div>
                                    <div class="space-y-2 text-sm">
                                        <p><span class="font-medium">Email:</span> {{ $enrollment->student->email }}</p>
                                        <p><span class="font-medium">Phone:</span> {{ $enrollment->student->phone ?? 'N/A' }}</p>
                                        <p><span class="font-medium">Status:</span> 
                                            <span class="px-2 py-1 text-xs rounded-full 
                                                @if($enrollment->student->status == 'active') bg-green-100 text-green-800
                                                @elseif($enrollment->student->status == 'inactive') bg-gray-100 text-gray-800
                                                @else bg-red-100 text-red-800 @endif">
                                                {{ ucfirst($enrollment->student->status) }}
                                            </span>
                                        </p>
                                    </div>
                                @else
                                    <p class="text-red-500">Student information not available</p>
                                @endif
                            </div>

                            <!-- Course Info -->
                            <div class="border rounded-lg p-4">
                                <h3 class="font-semibold text-gray-700 mb-3">Course Information</h3>
                                @if($enrollment->course)
                                    <div class="space-y-2 text-sm">
                                        <p><span class="font-medium">Course Name:</span> {{ $enrollment->course->title }}</p>
                                        <p><span class="font-medium">Course Code:</span> 
                                            <span class="font-mono bg-gray-100 px-2 py-1 rounded">{{ $enrollment->course->code }}</span>
                                        </p>
                                        <p><span class="font-medium">Level:</span> {{ $enrollment->course->level }}</p>
                                        <p><span class="font-medium">Credits:</span> {{ $enrollment->course->credits }}</p>
                                        <p><span class="font-medium">Status:</span> 
                                            <span class="px-2 py-1 text-xs rounded-full 
                                                @if($enrollment->course->is_active) bg-green-100 text-green-800
                                                @else bg-red-100 text-red-800 @endif">
                                                {{ $enrollment->course->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </p>
                                    </div>
                                @else
                                    <p class="text-red-500">Course information not available</p>
                                @endif
                            </div>

                            <!-- Enrollment Details -->
                            <div class="border rounded-lg p-4">
                                <h3 class="font-semibold text-gray-700 mb-3">Enrollment Details</h3>
                                <div class="space-y-2 text-sm">
                                    <p><span class="font-medium">Enrollment Date:</span> {{ $enrollment->enrollment_date->format('M d, Y') }}</p>
                                    <p><span class="font-medium">Status:</span> 
                                        <span class="px-2 py-1 text-xs rounded-full 
                                            @if($enrollment->status == 'active') bg-green-100 text-green-800
                                            @elseif($enrollment->status == 'completed') bg-blue-100 text-blue-800
                                            @elseif($enrollment->status == 'dropped') bg-gray-100 text-gray-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst($enrollment->status) }}
                                        </span>
                                    </p>
                                    @if($enrollment->grade)
                                        <p><span class="font-medium">Grade:</span> 
                                            <span class="font-bold text-lg 
                                                @if($enrollment->grade >= 90) text-green-600
                                                @elseif($enrollment->grade >= 80) text-blue-600
                                                @elseif($enrollment->grade >= 70) text-yellow-600
                                                @else text-red-600 @endif">
                                                {{ $enrollment->grade }}%
                                            </span>
                                        </p>
                                    @else
                                        <p><span class="font-medium">Grade:</span> <span class="text-gray-500">Not graded yet</span></p>
                                    @endif
                                </div>
                            </div>

                            <!-- Additional Info -->
                            <div class="border rounded-lg p-4">
                                <h3 class="font-semibold text-gray-700 mb-3">Additional Information</h3>
                                <div class="space-y-2 text-sm">
                                    <p><span class="font-medium">Created:</span> {{ $enrollment->created_at->format('M d, Y h:i A') }}</p>
                                    <p><span class="font-medium">Last Updated:</span> {{ $enrollment->updated_at->format('M d, Y h:i A') }}</p>
                                    @if($enrollment->notes)
                                        <div>
                                            <p class="font-medium mb-1">Notes:</p>
                                            <p class="text-gray-600 bg-gray-50 p-2 rounded">{{ $enrollment->notes }}</p>
                                        </div>
                                    @else
                                        <p><span class="font-medium">Notes:</span> <span class="text-gray-500">No notes</span></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-center space-x-4">
                    <a href="{{ route('enrollments.index') }}" 
                       class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                        <i class="fas fa-list mr-2"></i> Back to Enrollments
                    </a>
                    <a href="{{ route('enrollments.edit', $enrollment->id) }}" 
                       class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-edit mr-2"></i> Edit Enrollment
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
