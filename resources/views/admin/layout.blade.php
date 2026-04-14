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
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        }
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-900 text-white">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 shadow-lg">
            <div class="p-6">
                <h1 class="text-xl font-bold text-white">Admin Dashboard</h1>
                <p class="text-gray-400 text-sm">Portfolio Management</p>
            </div>
            
            <nav class="mt-6">
                <div class="px-6 py-2">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Main</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700 text-white' : '' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
                
                <div class="px-6 py-2 mt-6">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Content</p>
                </div>
                <a href="{{ route('admin.projects.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.projects.*') ? 'bg-gray-700 text-white' : '' }}">
                    <i class="fas fa-project-diagram mr-3"></i>
                    Projects
                </a>
                <a href="{{ route('admin.upcoming-projects.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.upcoming-projects.*') ? 'bg-gray-700 text-white' : '' }}">
                    <i class="fas fa-flask mr-3"></i>
                    In the Lab
                </a>
                <a href="{{ route('admin.skills.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.skills.*') ? 'bg-gray-700 text-white' : '' }}">
                    <i class="fas fa-cogs mr-3"></i>
                    Skills
                </a>
                <a href="{{ route('admin.qa-achievements.index') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.qa-achievements.*') ? 'bg-gray-700 text-white' : '' }}">
                    <i class="fas fa-bug mr-3"></i>
                    QA Achievements
                </a>
                
                <div class="px-6 py-2 mt-6">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Settings</p>
                </div>
                <a href="{{ route('admin.settings') }}" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.settings') ? 'bg-gray-700 text-white' : '' }}">
                    <i class="fas fa-cog mr-3"></i>
                    General Settings
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-gray-800 shadow-sm border-b border-gray-700">
                <div class="flex items-center justify-between px-6 py-4">
                    <div>
                        <h2 class="text-xl font-semibold text-white">@yield('page-title', 'Dashboard')</h2>
                        <p class="text-sm text-gray-400">@yield('page-description', 'Manage your portfolio content')</p>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('home') }}" target="_blank" class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-colors">
                            <i class="fas fa-external-link-alt mr-2"></i>
                            View Site
                        </a>
                        
                        <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-900 p-6">
                @if(session('success'))
                    <div class="bg-green-500/20 border border-green-500/50 rounded-lg p-4 mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-400 mr-2"></i>
                            <span class="text-green-300">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-500/20 border border-red-500/50 rounded-lg p-4 mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-triangle text-red-400 mr-2"></i>
                            <span class="text-red-300">{{ session('error') }}</span>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>