<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
        .fade-in {
            animation: fadeIn 2s ease-out;
        }
        @keyframes morph {
            0%, 100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
            50% { border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%; }
        }
        .morph {
            animation: morph 8s ease-in-out infinite;
        }
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .rotate {
            animation: rotate 20s linear infinite;
        }
        .glow {
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.5), 0 0 40px rgba(99, 102, 241, 0.3), 0 0 60px rgba(99, 102, 241, 0.1);
        }
        .text-glow {
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.8), 0 0 20px rgba(255, 255, 255, 0.6), 0 0 30px rgba(255, 255, 255, 0.4);
        }
        .neon-border {
            border: 2px solid transparent;
            background: linear-gradient(45deg, #6366f1, #8b5cf6, #ec4899, #6366f1) border-box;
            background-clip: padding-box, border-box;
            background-origin: padding-box, border-box;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center relative overflow-hidden bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
    <!-- Animated Background Grid -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: linear-gradient(rgba(99, 102, 241, 0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(99, 102, 241, 0.1) 1px, transparent 1px); background-size: 50px 50px;"></div>
    </div>
    
    <!-- Floating Geometric Shapes -->
    <div class="absolute top-10 left-10 w-32 h-32 bg-gradient-to-br from-blue-200 to-indigo-300 morph opacity-40"></div>
    <div class="absolute top-20 right-20 w-24 h-24 bg-gradient-to-br from-indigo-200 to-purple-300 rounded-full rotate opacity-30"></div>
    <div class="absolute bottom-20 left-32 w-40 h-40 bg-gradient-to-br from-purple-200 to-pink-300 morph opacity-35" style="animation-delay: 3s;"></div>
    <div class="absolute top-1/2 right-10 w-16 h-16 bg-gradient-to-br from-blue-200 to-cyan-300 rotate opacity-40" style="animation-delay: 5s;"></div>
    
    <!-- Main Content -->
    <div class="relative z-20 text-center fade-in max-w-2xl mx-auto px-6">
        <!-- Unique Logo Container -->
        <div class="mb-12 relative">
            <!-- Outer Ring -->
            <div class="w-40 h-40 mx-auto relative">
                <div class="absolute inset-0 rounded-full border-4 border-gradient-to-r from-blue-400 via-indigo-400 to-purple-400 rotate glow"></div>
                <div class="absolute inset-2 rounded-full border-2 border-white/40 rotate" style="animation-direction: reverse; animation-duration: 15s;"></div>
                
                <!-- Inner Logo -->
                <div class="absolute inset-4 rounded-full bg-gradient-to-br from-white to-gray-50 flex items-center justify-center shadow-xl">
                    <div class="w-24 h-24 rounded-xl bg-gradient-to-br from-blue-500 via-indigo-500 to-purple-500 flex items-center justify-center transform hover:scale-110 transition-transform duration-300 shadow-lg">
                        <i class="fas fa-graduation-cap text-white text-4xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Orbiting Dots -->
            <div class="absolute top-0 left-1/2 w-1 h-40 -translate-x-1/2 rotate">
                <div class="absolute top-0 left-1/2 w-3 h-3 bg-cyan-500 rounded-full -translate-x-1/2 -translate-y-1/2 shadow-lg"></div>
            </div>
            <div class="absolute top-0 left-1/2 w-1 h-40 -translate-x-1/2 rotate" style="animation-delay: 2s;">
                <div class="absolute top-0 left-1/2 w-3 h-3 bg-purple-500 rounded-full -translate-x-1/2 -translate-y-1/2 shadow-lg"></div>
            </div>
            <div class="absolute top-0 left-1/2 w-1 h-40 -translate-x-1/2 rotate" style="animation-delay: 4s;">
                <div class="absolute top-0 left-1/2 w-3 h-3 bg-pink-500 rounded-full -translate-x-1/2 -translate-y-1/2 shadow-lg"></div>
            </div>
        </div>
        
        <!-- Unique Title with Gradient -->
        <div class="mb-8">
            <h1 class="text-6xl font-black mb-4">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600">
                    Student Management <br> System
                </span>
            </h1>
        </div>
        
        <!-- Creative Description -->
        <p class="text-gray-500 text-lg mb-12 max-w-lg mx-auto leading-relaxed">
            <span class="text-blue-500">◆</span> Transform education management 
            <span class="text-indigo-500">◆</span> Streamline academic workflows 
            <span class="text-purple-500">◆</span> Empower student success
        </p>
        
        <!-- Futuristic Button -->
        <div class="mb-10">
            <a href="{{ route('dashboard') }}" 
               class="group relative inline-flex items-center px-12 py-4 neon-border rounded-2xl font-bold text-white text-lg transition-all duration-300 overflow-hidden shadow-xl">
                <span class="absolute inset-0 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                <span class="relative flex items-center">
                    <i class="fas fa-rocket mr-3 group-hover:translate-x-1 transition-transform duration-300"></i>
                    Launch Dashboard
                </span>
            </a>
        </div>
        
        <!-- Feature Pills -->
        <div class="flex flex-wrap justify-center gap-3 mb-8">
            <span class="px-4 py-2 bg-blue-100 border border-blue-300 rounded-full text-blue-700 text-sm shadow-sm">
                <i class="fas fa-users mr-2"></i>360° Management
            </span>
            <span class="px-4 py-2 bg-indigo-100 border border-indigo-300 rounded-full text-indigo-700 text-sm shadow-sm">
                <i class="fas fa-brain mr-2"></i>Smart Analytics
            </span>
            <span class="px-4 py-2 bg-purple-100 border border-purple-300 rounded-full text-purple-700 text-sm shadow-sm">
                <i class="fas fa-infinity mr-2"></i>Seamless Flow
            </span>
        </div>
        
        <!-- Unique Footer -->
        <div class="text-gray-400 text-sm">
            <span class="inline-block animate-pulse">▸</span> Next-Gen Education Platform 
            <span class="inline-block animate-pulse" style="animation-delay: 1s;">▸</span> Est. 2024
        </div>
    </div>
</body>
</html>
