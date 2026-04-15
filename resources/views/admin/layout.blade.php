<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            500: '#6366f1',
                            600: '#5b21b6',
                            700: '#4c1d95',
                        },
                        secondary: {
                            500: '#ec4899',
                            600: '#db2777',
                            700: '#be185d',
                        }
                    },
                    animation: {
                        'slide-in': 'slideIn 0.3s ease-out',
                        'fade-in': 'fadeIn 0.5s ease-out',
                        'bounce-in': 'bounceIn 0.6s ease-out',
                        'scale-in': 'scaleIn 0.4s ease-out',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        @keyframes slideIn {
            from { transform: translateX(-100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes bounceIn {
            0% { transform: scale(0.3) rotate(-10deg); opacity: 0; }
            50% { transform: scale(1.1) rotate(5deg); opacity: 1; }
            100% { transform: scale(1) rotate(0deg); opacity: 1; }
        }
        
        @keyframes scaleIn {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #f5576c 75%, #4facfe 100%);
        }
        
        .sidebar-overlay {
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
        }
        
        .menu-item {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .menu-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(99, 102, 241, 0.2), transparent);
            transition: left 0.5s ease;
        }
        
        .menu-item:hover::before {
            left: 100%;
        }
        
        .menu-item:hover {
            transform: translateX(8px);
            background: rgba(99, 102, 241, 0.1);
        }
        
        .menu-item.active {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.2), rgba(236, 72, 153, 0.2));
            border-left: 4px solid #6366f1;
        }
        
        .stat-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .stat-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }
        
        .mobile-menu-btn {
            transition: all 0.3s ease;
        }
        
        .mobile-menu-btn:hover {
            transform: scale(1.1) rotate(5deg);
            background: rgba(99, 102, 241, 0.2);
        }
        
        .hamburger-line {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .menu-open .hamburger-line:nth-child(1) {
            transform: rotate(45deg) translate(6px, 6px);
        }
        
        .menu-open .hamburger-line:nth-child(2) {
            opacity: 0;
            transform: scale(0);
        }
        
        .menu-open .hamburger-line:nth-child(3) {
            transform: rotate(-45deg) translate(6px, -6px);
        }
    </style>
</head>
<body class="bg-gray-900 text-white overflow-x-hidden">
    <!-- Mobile Menu Overlay -->
    <div id="mobile-overlay" class="fixed inset-0 sidebar-overlay z-40 lg:hidden hidden"></div>
    
    <div class="flex h-screen relative">
        <!-- Mobile Menu Button -->
        <button id="mobile-menu-btn" class="lg:hidden fixed top-4 left-4 z-50 p-3 rounded-xl mobile-menu-btn glass-effect">
            <div class="w-6 h-5 flex flex-col justify-between">
                <span class="hamburger-line w-full h-0.5 bg-white rounded"></span>
                <span class="hamburger-line w-full h-0.5 bg-white rounded"></span>
                <span class="hamburger-line w-full h-0.5 bg-white rounded"></span>
            </div>
        </button>

        <!-- Sidebar -->
        <div id="sidebar" class="fixed lg:relative w-80 bg-gray-800 shadow-2xl z-40 h-full transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
            <!-- Sidebar Header -->
            <div class="p-6 gradient-bg">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center animate-bounce-in">
                        <i class="fas fa-user-shield text-2xl text-white"></i>
                    </div>
                    <div class="animate-fade-in">
                        <h1 class="text-xl font-bold text-white">Admin Dashboard</h1>
                        <p class="text-white/80 text-sm">Portfolio Management</p>
                    </div>
                </div>
            </div>
            
            <!-- Navigation -->
            <nav class="mt-6 px-4 space-y-2">
                <!-- Main Section -->
                <div class="mb-6">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 mb-3">
                        <i class="fas fa-home mr-2"></i>Main
                    </p>
                    <a href="{{ route('admin.dashboard') }}" class="menu-item flex items-center px-4 py-3 text-gray-300 hover:text-white rounded-xl transition-all {{ request()->routeIs('admin.dashboard') ? 'active text-white' : '' }}">
                        <div class="w-10 h-10 rounded-lg bg-blue-500/20 flex items-center justify-center mr-3">
                            <i class="fas fa-tachometer-alt text-blue-400"></i>
                        </div>
                        <span class="font-medium">Dashboard</span>
                    </a>
                </div>
                
                <!-- Content Section -->
                <div class="mb-6">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 mb-3">
                        <i class="fas fa-folder mr-2"></i>Content
                    </p>
                    <a href="{{ route('admin.projects.index') }}" class="menu-item flex items-center px-4 py-3 text-gray-300 hover:text-white rounded-xl transition-all {{ request()->routeIs('admin.projects.*') ? 'active text-white' : '' }}">
                        <div class="w-10 h-10 rounded-lg bg-purple-500/20 flex items-center justify-center mr-3">
                            <i class="fas fa-project-diagram text-purple-400"></i>
                        </div>
                        <span class="font-medium">Projects</span>
                    </a>
                    <a href="{{ route('admin.upcoming-projects.index') }}" class="menu-item flex items-center px-4 py-3 text-gray-300 hover:text-white rounded-xl transition-all {{ request()->routeIs('admin.upcoming-projects.*') ? 'active text-white' : '' }}">
                        <div class="w-10 h-10 rounded-lg bg-green-500/20 flex items-center justify-center mr-3">
                            <i class="fas fa-flask text-green-400"></i>
                        </div>
                        <span class="font-medium">In the Lab</span>
                    </a>
                    <a href="{{ route('admin.skills.index') }}" class="menu-item flex items-center px-4 py-3 text-gray-300 hover:text-white rounded-xl transition-all {{ request()->routeIs('admin.skills.*') ? 'active text-white' : '' }}">
                        <div class="w-10 h-10 rounded-lg bg-yellow-500/20 flex items-center justify-center mr-3">
                            <i class="fas fa-cogs text-yellow-400"></i>
                        </div>
                        <span class="font-medium">Skills</span>
                    </a>
                    <a href="{{ route('admin.qa-achievements.index') }}" class="menu-item flex items-center px-4 py-3 text-gray-300 hover:text-white rounded-xl transition-all {{ request()->routeIs('admin.qa-achievements.*') ? 'active text-white' : '' }}">
                        <div class="w-10 h-10 rounded-lg bg-red-500/20 flex items-center justify-center mr-3">
                            <i class="fas fa-bug text-red-400"></i>
                        </div>
                        <span class="font-medium">QA Achievements</span>
                    </a>
                    <a href="{{ route('admin.cvs.index') }}" class="menu-item flex items-center px-4 py-3 text-gray-300 hover:text-white rounded-xl transition-all {{ request()->routeIs('admin.cvs.*') ? 'active text-white' : '' }}">
                        <div class="w-10 h-10 rounded-lg bg-emerald-500/20 flex items-center justify-center mr-3">
                            <i class="fas fa-file-pdf text-emerald-400"></i>
                        </div>
                        <span class="font-medium">CVs / Resumes</span>
                    </a>
                </div>
                
                <!-- Settings Section -->
                <div class="mb-6">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 mb-3">
                        <i class="fas fa-cog mr-2"></i>Settings
                    </p>
                    <a href="{{ route('admin.settings') }}" class="menu-item flex items-center px-4 py-3 text-gray-300 hover:text-white rounded-xl transition-all {{ request()->routeIs('admin.settings') ? 'active text-white' : '' }}">
                        <div class="w-10 h-10 rounded-lg bg-indigo-500/20 flex items-center justify-center mr-3">
                            <i class="fas fa-sliders-h text-indigo-400"></i>
                        </div>
                        <span class="font-medium">General Settings</span>
                    </a>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden lg:ml-0">
            <!-- Header -->
            <header class="glass-effect shadow-lg border-b border-white/10 animate-fade-in">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="ml-16 lg:ml-0">
                        <h2 class="text-2xl font-bold text-white">@yield('page-title', 'Dashboard')</h2>
                        <p class="text-sm text-gray-400 mt-1">@yield('page-description', 'Manage your portfolio content and analytics')</p>
                    </div>
                    
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('home') }}" target="_blank" class="px-4 py-2 bg-gradient-to-r from-primary-500 to-secondary-500 hover:from-primary-600 hover:to-secondary-600 text-white rounded-xl transition-all transform hover:scale-105 shadow-lg">
                            <i class="fas fa-external-link-alt mr-2"></i>
                            <span class="hidden sm:inline">View Site</span>
                        </a>
                        
                        <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-xl transition-all transform hover:scale-105 shadow-lg">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                <span class="hidden sm:inline">Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-900 p-6">
                @if(session('success'))
                    <div class="bg-green-500/20 border border-green-500/50 rounded-xl p-4 mb-6 animate-bounce-in">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-lg bg-green-500/20 flex items-center justify-center mr-3">
                                <i class="fas fa-check-circle text-green-400"></i>
                            </div>
                            <span class="text-green-300 font-medium">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-500/20 border border-red-500/50 rounded-xl p-4 mb-6 animate-bounce-in">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-lg bg-red-500/20 flex items-center justify-center mr-3">
                                <i class="fas fa-exclamation-triangle text-red-400"></i>
                            </div>
                            <span class="text-red-300 font-medium">{{ session('error') }}</span>
                        </div>
                    </div>
                @endif

                <div class="animate-fade-in">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
        // Mobile menu functionality
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('mobile-overlay');
        
        function toggleMobileMenu() {
            const isOpen = sidebar.classList.contains('translate-x-0');
            
            if (isOpen) {
                // Close menu
                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                mobileMenuBtn.classList.remove('menu-open');
            } else {
                // Open menu
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                overlay.classList.remove('hidden');
                mobileMenuBtn.classList.add('menu-open');
            }
        }
        
        mobileMenuBtn.addEventListener('click', toggleMobileMenu);
        overlay.addEventListener('click', toggleMobileMenu);
        
        // Close menu on window resize if desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('translate-x-0', '-translate-x-full');
                overlay.classList.add('hidden');
                mobileMenuBtn.classList.remove('menu-open');
            }
        });
        
        // Add staggered animations to menu items
        document.addEventListener('DOMContentLoaded', () => {
            const menuItems = document.querySelectorAll('.menu-item');
            menuItems.forEach((item, index) => {
                item.style.animationDelay = `${index * 0.1}s`;
                item.classList.add('animate-slide-in');
            });
        });
    </script>

    @stack('scripts')
</body>
</html>