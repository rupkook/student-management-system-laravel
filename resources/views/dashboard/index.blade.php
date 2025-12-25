<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
                <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 bg-white bg-opacity-20 hover:bg-opacity-30 transition">
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
                            <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
                            <p class="text-gray-600 text-sm">Welcome to your student management system</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-500">{{ now()->format('l, F j, Y') }}</span>
                            <div class="bg-purple-100 rounded-full p-2">
                                <i class="fas fa-user text-purple-600"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="p-6">
                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 card-hover text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-blue-100 text-sm font-medium">Total Students</p>
                                <p class="text-3xl font-bold text-white mt-2">{{ $totalStudents }}</p>
                                <p class="text-blue-100 text-sm mt-2 flex items-center">
                                    <i class="fas fa-arrow-up mr-1"></i>12% from last month
                                </p>
                            </div>
                            <div class="bg-white bg-opacity-20 p-4 rounded-xl backdrop-blur-sm">
                                <i class="fas fa-user-graduate text-white text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 card-hover text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-green-100 text-sm font-medium">Active Students</p>
                                <p class="text-3xl font-bold text-white mt-2">{{ $activeStudents }}</p>
                                <p class="text-green-100 text-sm mt-2 flex items-center">
                                    <i class="fas fa-arrow-up mr-1"></i>8% from last month
                                </p>
                            </div>
                            <div class="bg-white bg-opacity-20 p-4 rounded-xl backdrop-blur-sm">
                                <i class="fas fa-check-circle text-white text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 card-hover text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-purple-100 text-sm font-medium">Total Courses</p>
                                <p class="text-3xl font-bold text-white mt-2">{{ $totalCourses }}</p>
                                <p class="text-purple-100 text-sm mt-2 flex items-center">
                                    <i class="fas fa-arrow-up mr-1"></i>2 new courses
                                </p>
                            </div>
                            <div class="bg-white bg-opacity-20 p-4 rounded-xl backdrop-blur-sm">
                                <i class="fas fa-book text-white text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-lg p-6 card-hover text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-orange-100 text-sm font-medium">Active Enrollments</p>
                                <p class="text-3xl font-bold text-white mt-2">{{ $totalEnrollments }}</p>
                                <p class="text-orange-100 text-sm mt-2 flex items-center">
                                    <i class="fas fa-arrow-up mr-1"></i>15% from last month
                                </p>
                            </div>
                            <div class="bg-white bg-opacity-20 p-4 rounded-xl backdrop-blur-sm">
                                <i class="fas fa-clipboard-list text-white text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tables Row -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Recent Students Table -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800">Recent Students</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full table-hover">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($recentStudents as $student)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-4 py-3">
                                                <div class="flex items-center">
                                                    <div class="bg-purple-100 rounded-full p-2 mr-3">
                                                        <i class="fas fa-user text-purple-600 text-xs"></i>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-900">{{ $student->full_name }}</p>
                                                        <p class="text-xs text-gray-500">{{ $student->email }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-900">{{ $student->student_id }}</td>
                                            <td class="px-4 py-3">
                                                <span class="px-2 py-1 text-xs rounded-full 
                                                    @if($student->status == 'active') bg-green-100 text-green-800
                                                    @elseif($student->status == 'inactive') bg-gray-100 text-gray-800
                                                    @elseif($student->status == 'suspended') bg-red-100 text-red-800
                                                    @else bg-blue-100 text-blue-800 @endif">
                                                    {{ ucfirst($student->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Recent Enrollments Table -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800">Recent Enrollments</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full table-hover">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Course</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($recentEnrollments as $enrollment)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-4 py-3">
                                                <div>
                                                    @if($enrollment->student)
                                                        <p class="text-sm font-medium text-gray-900">{{ $enrollment->student->full_name }}</p>
                                                        <p class="text-xs text-gray-500">{{ $enrollment->student->student_id }}</p>
                                                    @else
                                                        <p class="text-sm font-medium text-gray-500">Student Not Found</p>
                                                        <p class="text-xs text-gray-400">ID: {{ $enrollment->student_id }}</p>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-4 py-3">
                                                <div>
                                                    @if($enrollment->course)
                                                        <p class="text-sm font-medium text-gray-900">{{ $enrollment->course->title }}</p>
                                                        <p class="text-xs text-gray-500">{{ $enrollment->course->code }}</p>
                                                    @else
                                                        <p class="text-sm font-medium text-gray-500">Course Not Found</p>
                                                        <p class="text-xs text-gray-400">ID: {{ $enrollment->course_id }}</p>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-4 py-3">
                                                <span class="px-2 py-1 text-xs rounded-full 
                                                    @if($enrollment->status == 'active') bg-green-100 text-green-800
                                                    @elseif($enrollment->status == 'completed') bg-blue-100 text-blue-800
                                                    @elseif($enrollment->status == 'dropped') bg-gray-100 text-gray-800
                                                    @else bg-red-100 text-red-800 @endif">
                                                    {{ ucfirst($enrollment->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Single Statistics Graph -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-semibold text-gray-800">Student Management Statistics</h3>
                        <div class="flex space-x-2">
                            <button onclick="updateStatsChart('overview')" class="px-3 py-1 text-xs bg-purple-100 text-purple-700 rounded-lg hover:bg-purple-200 transition">Overview</button>
                            <button onclick="updateStatsChart('students')" class="px-3 py-1 text-xs bg-purple-100 text-purple-700 rounded-lg hover:bg-purple-200 transition">Students</button>
                            <button onclick="updateStatsChart('courses')" class="px-3 py-1 text-xs bg-purple-100 text-purple-700 rounded-lg hover:bg-purple-200 transition">Courses</button>
                            <button onclick="updateStatsChart('enrollments')" class="px-3 py-1 text-xs bg-purple-100 text-purple-700 rounded-lg hover:bg-purple-200 transition">Enrollments</button>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mb-6">
                        <div class="text-center p-4 bg-blue-50 rounded-lg">
                            <p class="text-2xl font-bold text-blue-600">{{ $totalStudents }}</p>
                            <p class="text-sm text-gray-600">Total Students</p>
                        </div>
                        <div class="text-center p-4 bg-green-50 rounded-lg">
                            <p class="text-2xl font-bold text-green-600">{{ $totalCourses }}</p>
                            <p class="text-sm text-gray-600">Total Courses</p>
                        </div>
                        <div class="text-center p-4 bg-purple-50 rounded-lg">
                            <p class="text-2xl font-bold text-purple-600">{{ $totalEnrollments }}</p>
                            <p class="text-sm text-gray-600">Total Enrollments</p>
                        </div>
                        <div class="text-center p-4 bg-orange-50 rounded-lg">
                            <p class="text-2xl font-bold text-orange-600">{{ $activeStudents }}</p>
                            <p class="text-sm text-gray-600">Active Students</p>
                        </div>
                    </div>
                    <canvas id="statsChart" style="max-height: 400px;"></canvas>
                </div>

                <!-- Top Students Table -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">Top Performing Students</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full table-hover">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rank</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Courses</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Average Grade</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($topStudents as $index => $student)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                @if($index < 3)
                                                    <div class="bg-yellow-100 rounded-full p-2 mr-2">
                                                        <i class="fas fa-trophy text-yellow-600 text-xs"></i>
                                                    </div>
                                                @endif
                                                <span class="text-sm font-medium text-gray-900">#{{ $index + 1 }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="bg-purple-100 rounded-full p-2 mr-3">
                                                    <i class="fas fa-user text-purple-600 text-xs"></i>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">{{ $student->full_name }}</p>
                                                    <p class="text-xs text-gray-500">{{ $student->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $student->student_id }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $student->enrollments->count() }}</td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <span class="text-sm font-medium text-gray-900">{{ number_format($student->average_grade, 1) }}%</span>
                                                <div class="ml-2 bg-green-100 rounded-full px-2 py-1">
                                                    <span class="text-xs text-green-800">Excellent</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                                {{ ucfirst($student->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Initialize data variables
        let studentsByStatus, coursesByLevel, enrollmentsByMonth;
        let totalStudents, totalCourses, totalEnrollments, activeStudents;
        
        // Set data from backend
        studentsByStatus = @json($studentsByStatus);
        coursesByLevel = @json($coursesByLevel);
        enrollmentsByMonth = @json($enrollmentsByMonth);
        
        // Set numeric data
        totalStudents = parseInt('{{ $totalStudents }}');
        totalCourses = parseInt('{{ $totalCourses }}');
        totalEnrollments = parseInt('{{ $totalEnrollments }}');
        activeStudents = parseInt('{{ $activeStudents }}');

        // Single Statistics Chart
        let statsChart;
        const statsCtx = document.getElementById('statsChart').getContext('2d');
        
        function updateStatsChart(type = 'overview') {
            if (statsChart) {
                statsChart.destroy();
            }

            let config = {
                type: 'bar',
                data: {
                    labels: [],
                    datasets: []
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                borderDash: [5, 5],
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            };

            switch(type) {
                case 'overview':
                    config.type = 'bar';
                    config.data.labels = ['Total Students', 'Total Courses', 'Total Enrollments', 'Active Students'];
                    config.data.datasets = [{
                        label: 'Overview Statistics',
                        data: [totalStudents, totalCourses, totalEnrollments, activeStudents],
                        backgroundColor: ['#3B82F6', '#10B981', '#8B5CF6', '#F59E0B'],
                        borderRadius: 8
                    }];
                    break;
                    
                case 'students':
                    config.type = 'doughnut';
                    config.data.labels = Object.keys(studentsByStatus);
                    config.data.datasets = [{
                        data: Object.values(studentsByStatus),
                        backgroundColor: ['#10B981', '#3B82F6', '#F59E0B', '#EF4444'],
                        borderWidth: 0
                    }];
                    config.options.scales = {};
                    break;
                    
                case 'courses':
                    config.type = 'polarArea';
                    config.data.labels = Object.keys(coursesByLevel);
                    config.data.datasets = [{
                        data: Object.values(coursesByLevel),
                        backgroundColor: ['#8B5CF6', '#3B82F6', '#10B981', '#F59E0B', '#EF4444'],
                        borderWidth: 0
                    }];
                    config.options.scales = {};
                    break;
                    
                case 'enrollments':
                    config.type = 'line';
                    config.data.labels = Object.keys(enrollmentsByMonth);
                    config.data.datasets = [{
                        label: 'Enrollments',
                        data: Object.values(enrollmentsByMonth),
                        borderColor: '#8B5CF6',
                        backgroundColor: 'rgba(139, 92, 246, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#8B5CF6',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5
                    }];
                    break;
            }

            statsChart = new Chart(statsCtx, config);
        }

        // Initialize chart on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateStatsChart('overview');
        });
    </script>
</body>
</html>
