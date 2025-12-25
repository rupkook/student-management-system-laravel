<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollments Management - EduManage</title>
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
                <a href="{{ route('courses.index') }}" class="flex items-center px-6 py-3 hover:bg-white hover:bg-opacity-10 transition">
                    <i class="fas fa-book w-5 mr-3"></i>
                    <span>Courses</span>
                </a>
                <a href="{{ route('enrollments.index') }}" class="flex items-center px-6 py-3 bg-white bg-opacity-20 hover:bg-opacity-30 transition">
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
                            <h1 class="text-2xl font-bold text-gray-800">Enrollments</h1>
                            <p class="text-gray-600 text-sm">Manage student course enrollments</p>
                        </div>
                        <a href="{{ route('enrollments.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition flex items-center">
                            <i class="fas fa-plus mr-2"></i> Add Enrollment
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
                    <div class="flex flex-wrap gap-4">
                        <div class="flex-1 min-w-[250px]">
                            <div class="relative">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                                <input type="text" placeholder="Search enrollments by student or course..." 
                                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div>
                        <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="completed">Completed</option>
                            <option value="dropped">Dropped</option>
                            <option value="failed">Failed</option>
                        </select>
                        <button class="bg-purple-100 text-purple-700 px-4 py-2 rounded-lg hover:bg-purple-200 transition">
                            <i class="fas fa-filter mr-2"></i> Filter
                        </button>
                    </div>
                </div>

                <!-- Enrollments Table -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-800">Enrollment Records</h3>
                            <span class="text-sm text-gray-500">{{ $enrollments->total() }} enrollments found</span>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full table-hover">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Enrollment Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grade</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($enrollments as $enrollment)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                @if($enrollment->student)
                                                    @if($enrollment->student->photo)
                                                        <img class="h-8 w-8 rounded-full object-cover" src="{{ asset('storage/'.$enrollment->student->photo) }}" alt="{{ $enrollment->student->full_name }}">
                                                    @else
                                                        <div class="h-8 w-8 rounded-full bg-purple-100 flex items-center justify-center">
                                                            <i class="fas fa-user text-purple-600 text-xs"></i>
                                                        </div>
                                                    @endif
                                                    <div class="ml-3">
                                                        <div class="text-sm font-medium text-gray-900">{{ $enrollment->student->full_name }}</div>
                                                        <div class="text-sm text-gray-500">{{ $enrollment->student->student_id }}</div>
                                                    </div>
                                                @else
                                                    <div class="h-8 w-8 rounded-full bg-red-100 flex items-center justify-center">
                                                        <i class="fas fa-exclamation-triangle text-red-600 text-xs"></i>
                                                    </div>
                                                    <div class="ml-3">
                                                        <div class="text-sm font-medium text-gray-500">Student Not Found</div>
                                                        <div class="text-sm text-gray-400">ID: {{ $enrollment->student_id }}</div>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ $enrollment->course->title }}</div>
                                                <div class="text-sm text-gray-500 font-mono bg-gray-100 px-2 py-1 rounded inline-block">{{ $enrollment->course->code }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $enrollment->enrollment_date->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs rounded-full font-medium
                                                @if($enrollment->status == 'active') bg-green-100 text-green-800
                                                @elseif($enrollment->status == 'completed') bg-blue-100 text-blue-800
                                                @elseif($enrollment->status == 'dropped') bg-gray-100 text-gray-800
                                                @else bg-red-100 text-red-800 @endif">
                                                {{ ucfirst($enrollment->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($enrollment->grade)
                                                <div>
                                                    <span class="text-sm font-medium text-gray-900">{{ $enrollment->grade }}%</span>
                                                    <span class="text-xs text-gray-500 ml-1">({{ $enrollment->grade_letter }})</span>
                                                </div>
                                            @else
                                                <span class="text-gray-400 text-sm">N/A</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('enrollments.show', $enrollment) }}" 
                                                   class="text-blue-600 hover:text-blue-800 transition p-1" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('enrollments.edit', $enrollment) }}" 
                                                   class="text-indigo-600 hover:text-indigo-800 transition p-1" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('enrollments.destroy', $enrollment) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 transition p-1" 
                                                            title="Delete" onclick="return confirm('Are you sure you want to delete this enrollment?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                <i class="fas fa-clipboard-list text-gray-400 text-6xl mb-4"></i>
                                                <p class="text-gray-500 text-lg">No enrollments found</p>
                                                <p class="text-gray-400 text-sm mt-1">Start by adding your first enrollment</p>
                                                <a href="{{ route('enrollments.create') }}" 
                                                   class="mt-4 bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">
                                                    <i class="fas fa-plus mr-2"></i> Add Enrollment
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="mt-6 flex justify-center">
                    {{ $enrollments->links() }}
                </div>
            </div>
        </main>
    </div>
</body>
</html>
