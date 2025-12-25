<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
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
                        <h1 class="text-3xl font-bold text-gray-800">Add New Course</h1>
                    </div>
                </div>
            </header>

            <div class="p-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <form action="{{ route('courses.store') }}" method="POST">
                        @csrf
                        
                        <!-- Course Information -->
                        <div class="mb-8">
                            <h2 class="text-xl font-semibold mb-4 text-gray-800">Course Information</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Course Code</label>
                                    <input type="text" name="code" required
                                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           value="{{ old('code') }}" placeholder="e.g., CS101">
                                    @error('code')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Course Title</label>
                                    <input type="text" name="title" required
                                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           value="{{ old('title') }}" placeholder="e.g., Introduction to Computer Science">
                                    @error('title')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Credit Hours</label>
                                    <input type="number" name="credit_hours" required min="1" max="10"
                                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           value="{{ old('credit_hours', 3) }}">
                                    @error('credit_hours')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Level</label>
                                    <select name="level" required
                                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Select Level</option>
                                        <option value="beginner" {{ old('level') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                                        <option value="intermediate" {{ old('level') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                        <option value="advanced" {{ old('level') == 'advanced' ? 'selected' : '' }}>Advanced</option>
                                    </select>
                                    @error('level')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                    <textarea name="description" rows="4"
                                              class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                              placeholder="Enter course description...">{{ old('description') }}</textarea>
                                    @error('description')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Active Course</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('courses.index') }}" 
                               class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                <i class="fas fa-save mr-2"></i> Save Course
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
