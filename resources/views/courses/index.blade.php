<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses Management - EduManage</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .table-hover tbody tr:hover {
            background-color: #f8fafc;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 sidebar-gradient text-white shadow-xl">
            <div class="p-6 border-b border-purple-700">
                <div class="flex items-center space-x-3">
                    <div class="bg-white rounded-lg p-2">
                        <i class="fas fa-graduation-cap text-purple-600 text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold">EduManage</h2>
                        <p class="text-purple-200 text-sm">Student Management</p>
                    </div>
                </div>
            </div>
            <nav class="mt-6">
                <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 hover:bg-white hover:bg-opacity-10 transition">
                    <i class="fas fa-tachometer-alt w-5 mr-3"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('students.index') }}" class="flex items-center px-6 py-3 hover:bg-white hover:bg-opacity-10 transition">
                    <i class="fas fa-user-graduate w-5 mr-3"></i>
                    <span>Students</span>
                </a>
                <a href="{{ route('courses.index') }}" class="flex items-center px-6 py-3 bg-white bg-opacity-20 hover:bg-opacity-30 transition">
                    <i class="fas fa-book w-5 mr-3"></i>
                    <span>Courses</span>
                </a>
                <a href="{{ route('enrollments.index') }}" class="flex items-center px-6 py-3 hover:bg-white hover:bg-opacity-10 transition">
                    <i class="fas fa-clipboard-list w-5 mr-3"></i>
                    <span>Enrollments</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Courses</h1>
                            <p class="text-gray-600 text-sm">Manage course catalog and information</p>
                        </div>
                        <a href="{{ route('courses.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition flex items-center">
                            <i class="fas fa-plus mr-2"></i> Add Course
                        </a>
                    </div>
                </div>
            </header>

            <div class="p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Search and Filter -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                    <form method="GET" action="{{ route('courses.index') }}">
                        <div class="flex flex-wrap gap-4">
                            <div class="flex-1 min-w-[250px]">
                                <div class="relative">
                                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                                    <input type="text" name="search" placeholder="Search courses by title or code..." 
                                           value="{{ request('search') }}"
                                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                                </div>
                            </div>
                            <select name="level" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                                <option value="">All Levels</option>
                                <option value="beginner" {{ request('level') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                                <option value="intermediate" {{ request('level') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                <option value="advanced" {{ request('level') == 'advanced' ? 'selected' : '' }}>Advanced</option>
                            </select>
                            <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                                <option value="">All Status</option>
                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            <button type="submit" class="bg-purple-100 text-purple-700 px-4 py-2 rounded-lg hover:bg-purple-200 transition">
                                <i class="fas fa-filter mr-2"></i> Filter
                            </button>
                            <a href="{{ route('courses.index') }}" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition">
                                <i class="fas fa-times mr-2"></i> Clear
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Courses Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($courses as $course)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $course->title }}</h3>
                                        <p class="text-sm text-gray-600 font-mono bg-gray-100 px-2 py-1 rounded inline-block">{{ $course->code }}</p>
                                    </div>
                                    <span class="px-2 py-1 text-xs rounded-full font-medium
                                        @if($course->level == 'beginner') bg-green-100 text-green-800
                                        @elseif($course->level == 'intermediate') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($course->level) }}
                                    </span>
                                </div>
                                
                                @if($course->description)
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ Str::limit($course->description, 80) }}</p>
                                @endif
                                
                                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                    <div class="flex items-center">
                                        <i class="fas fa-clock mr-1 text-purple-600"></i>
                                        <span>{{ $course->credit_hours }} credits</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-users mr-1 text-purple-600"></i>
                                        <span>{{ $course->enrolled_students_count ?? 0 }} students</span>
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <span class="px-2 py-1 text-xs rounded-full font-medium
                                        @if($course->is_active) bg-green-100 text-green-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ $course->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('courses.show', $course) }}" 
                                           class="text-blue-600 hover:text-blue-800 transition p-1" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('courses.edit', $course) }}" 
                                           class="text-indigo-600 hover:text-indigo-800 transition p-1" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('courses.destroy', $course) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 transition p-1" 
                                                    title="Delete" onclick="return confirm('Are you sure you want to delete this course?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full">
                            <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                                <i class="fas fa-book text-gray-400 text-6xl mb-4"></i>
                                <p class="text-gray-500 text-lg">No courses found</p>
                                <p class="text-gray-400 text-sm mt-1">Start by adding your first course</p>
                                <a href="{{ route('courses.create') }}" 
                                   class="mt-4 bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition inline-block">
                                    <i class="fas fa-plus mr-2"></i> Add Course
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-6 flex justify-center">
                    {{ $courses->links() }}
                </div>
            </div>
        </main>
    </div>
</body>
</html>
