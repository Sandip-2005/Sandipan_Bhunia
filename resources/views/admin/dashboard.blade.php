@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-description', 'Overview of your portfolio content and analytics')

@section('content')
<!-- Visit Statistics Cards -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="stat-card glass-effect rounded-2xl p-6 animate-scale-in">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-400 mb-1">Total Visits</p>
                <p class="text-3xl font-bold text-white">{{ $stats['total_visits'] }}</p>
                <p class="text-xs text-blue-400 mt-1">
                    <i class="fas fa-arrow-up mr-1"></i>+12% from last month
                </p>
            </div>
            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center animate-bounce-in">
                <i class="fas fa-eye text-2xl text-white"></i>
            </div>
        </div>
    </div>

    <div class="stat-card glass-effect rounded-2xl p-6 animate-scale-in" style="animation-delay: 0.1s;">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-400 mb-1">Unique Visitors</p>
                <p class="text-3xl font-bold text-white">{{ $stats['unique_visitors'] }}</p>
                <p class="text-xs text-green-400 mt-1">
                    <i class="fas fa-arrow-up mr-1"></i>+8% from last month
                </p>
            </div>
            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center animate-bounce-in">
                <i class="fas fa-users text-2xl text-white"></i>
            </div>
        </div>
    </div>

    <div class="stat-card glass-effect rounded-2xl p-6 animate-scale-in" style="animation-delay: 0.2s;">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-400 mb-1">Today</p>
                <p class="text-3xl font-bold text-white">{{ $stats['today_visits'] }}</p>
                <p class="text-xs text-yellow-400 mt-1">
                    <i class="fas fa-clock mr-1"></i>Live tracking
                </p>
            </div>
            <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-2xl flex items-center justify-center animate-bounce-in">
                <i class="fas fa-calendar-day text-2xl text-white"></i>
            </div>
        </div>
    </div>

    <div class="stat-card glass-effect rounded-2xl p-6 animate-scale-in" style="animation-delay: 0.3s;">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-400 mb-1">This Month</p>
                <p class="text-3xl font-bold text-white">{{ $stats['monthly_visits'] }}</p>
                <p class="text-xs text-purple-400 mt-1">
                    <i class="fas fa-chart-line mr-1"></i>Trending up
                </p>
            </div>
            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center animate-bounce-in">
                <i class="fas fa-calendar-alt text-2xl text-white"></i>
            </div>
        </div>
    </div>
</div>

<!-- Content Statistics Cards -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="stat-card glass-effect rounded-2xl p-6 animate-fade-in" style="animation-delay: 0.4s;">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-400 mb-1">Projects</p>
                <p class="text-2xl font-bold text-white">{{ $stats['projects'] }}</p>
            </div>
            <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                <i class="fas fa-project-diagram text-blue-400"></i>
            </div>
        </div>
    </div>

    <div class="stat-card glass-effect rounded-2xl p-6 animate-fade-in" style="animation-delay: 0.5s;">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-400 mb-1">In Lab</p>
                <p class="text-2xl font-bold text-white">{{ $stats['upcoming_projects'] }}</p>
            </div>
            <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center">
                <i class="fas fa-flask text-purple-400"></i>
            </div>
        </div>
    </div>

    <div class="stat-card glass-effect rounded-2xl p-6 animate-fade-in" style="animation-delay: 0.6s;">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-400 mb-1">Skills</p>
                <p class="text-2xl font-bold text-white">{{ $stats['skills'] }}</p>
            </div>
            <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                <i class="fas fa-cogs text-green-400"></i>
            </div>
        </div>
    </div>

    <div class="stat-card glass-effect rounded-2xl p-6 animate-fade-in" style="animation-delay: 0.7s;">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-400 mb-1">QA Achievements</p>
                <p class="text-2xl font-bold text-white">{{ $stats['qa_achievements'] }}</p>
            </div>
            <div class="w-12 h-12 bg-red-500/20 rounded-xl flex items-center justify-center">
                <i class="fas fa-bug text-red-400"></i>
            </div>
        </div>
    </div>
</div>

<div class="grid lg:grid-cols-2 gap-6 mb-8">
    <!-- Recent Projects -->
    <div class="glass-effect rounded-2xl overflow-hidden animate-slide-in">
        <div class="p-6 border-b border-white/10">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <div class="w-8 h-8 bg-blue-500/20 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-project-diagram text-blue-400"></i>
                    </div>
                    Recent Projects
                </h3>
                <a href="{{ route('admin.projects.index') }}" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white rounded-xl transition-all transform hover:scale-105 text-sm font-medium">
                    View All
                </a>
            </div>
        </div>
        <div class="p-6">
            @if($recentProjects->count() > 0)
                <div class="space-y-4">
                    @foreach($recentProjects as $index => $project)
                    <div class="flex items-center justify-between p-4 bg-white/5 hover:bg-white/10 rounded-xl transition-all transform hover:scale-102 animate-fade-in" style="animation-delay: {{ 0.8 + ($index * 0.1) }}s;">
                        <div class="flex-1">
                            <h4 class="font-semibold text-white mb-1">{{ $project->title }}</h4>
                            <p class="text-gray-400 text-sm mb-2">{{ Str::limit($project->description, 60) }}</p>
                            <div class="flex gap-2">
                                @if($project->is_featured)
                                    <span class="px-2 py-1 bg-yellow-500/20 text-yellow-400 rounded-lg text-xs font-medium">Featured</span>
                                @endif
                                @if($project->is_active)
                                    <span class="px-2 py-1 bg-green-500/20 text-green-400 rounded-lg text-xs font-medium">Active</span>
                                @endif
                            </div>
                        </div>
                        <div class="text-right ml-4">
                            <p class="text-xs text-gray-400">{{ $project->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-blue-500/20 rounded-2xl flex items-center justify-center mx-auto mb-4 animate-bounce-in">
                        <i class="fas fa-project-diagram text-3xl text-blue-400"></i>
                    </div>
                    <p class="text-gray-400 mb-4">No projects yet</p>
                    <a href="{{ route('admin.projects.create') }}" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white rounded-xl transition-all transform hover:scale-105 font-medium">
                        Create First Project
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Recent Lab Projects -->
    <div class="glass-effect rounded-2xl overflow-hidden animate-slide-in" style="animation-delay: 0.2s;">
        <div class="p-6 border-b border-white/10">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <div class="w-8 h-8 bg-purple-500/20 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-flask text-purple-400"></i>
                    </div>
                    In the Lab
                </h3>
                <a href="{{ route('admin.upcoming-projects.index') }}" class="px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white rounded-xl transition-all transform hover:scale-105 text-sm font-medium">
                    View All
                </a>
            </div>
        </div>
        <div class="p-6">
            @if($recentUpcoming->count() > 0)
                <div class="space-y-4">
                    @foreach($recentUpcoming as $index => $project)
                    <div class="p-4 bg-white/5 hover:bg-white/10 rounded-xl transition-all animate-fade-in" style="animation-delay: {{ 1.0 + ($index * 0.1) }}s;">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-semibold text-white">{{ $project->title }}</h4>
                            <span class="px-3 py-1 {{ $project->status == 'in_progress' ? 'bg-yellow-500/20 text-yellow-400' : ($project->status == 'planning' ? 'bg-blue-500/20 text-blue-400' : 'bg-gray-500/20 text-gray-400') }} rounded-lg text-xs font-medium">
                                {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                            </span>
                        </div>
                        <p class="text-gray-400 text-sm mb-3">{{ Str::limit($project->description, 60) }}</p>
                        
                        <!-- Progress Bar -->
                        <div class="mb-3">
                            <div class="flex justify-between text-xs text-gray-400 mb-2">
                                <span>Progress</span>
                                <span>{{ $project->progress_percentage }}%</span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-2 rounded-full transition-all duration-1000" style="width: {{ $project->progress_percentage }}%"></div>
                            </div>
                        </div>
                        
                        <p class="text-xs text-gray-400 flex items-center">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            Expected: {{ $project->expected_completion->format('M Y') }}
                        </p>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-purple-500/20 rounded-2xl flex items-center justify-center mx-auto mb-4 animate-bounce-in">
                        <i class="fas fa-flask text-3xl text-purple-400"></i>
                    </div>
                    <p class="text-gray-400 mb-4">No lab projects</p>
                    <a href="{{ route('admin.upcoming-projects.create') }}" class="px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white rounded-xl transition-all transform hover:scale-105 font-medium">
                        Add to Lab
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="animate-fade-in" style="animation-delay: 0.4s;">
    <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
        <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-500 rounded-lg flex items-center justify-center mr-3">
            <i class="fas fa-bolt text-white"></i>
        </div>
        Quick Actions
    </h3>
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">
        <a href="{{ route('admin.projects.create') }}" class="group p-6 glass-effect hover:bg-white/10 rounded-2xl transition-all transform hover:scale-105 hover:-translate-y-2 animate-bounce-in" style="animation-delay: 1.2s;">
            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <i class="fas fa-plus text-white"></i>
            </div>
            <h4 class="font-semibold text-white mb-1">New Project</h4>
            <p class="text-gray-400 text-sm">Add completed project</p>
        </a>

        <a href="{{ route('admin.upcoming-projects.create') }}" class="group p-6 glass-effect hover:bg-white/10 rounded-2xl transition-all transform hover:scale-105 hover:-translate-y-2 animate-bounce-in" style="animation-delay: 1.3s;">
            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <i class="fas fa-flask text-white"></i>
            </div>
            <h4 class="font-semibold text-white mb-1">Lab Project</h4>
            <p class="text-gray-400 text-sm">Add work in progress</p>
        </a>

        <a href="{{ route('admin.skills.create') }}" class="group p-6 glass-effect hover:bg-white/10 rounded-2xl transition-all transform hover:scale-105 hover:-translate-y-2 animate-bounce-in" style="animation-delay: 1.4s;">
            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <i class="fas fa-cog text-white"></i>
            </div>
            <h4 class="font-semibold text-white mb-1">New Skill</h4>
            <p class="text-gray-400 text-sm">Add technology skill</p>
        </a>

        <a href="{{ route('admin.qa-achievements.create') }}" class="group p-6 glass-effect hover:bg-white/10 rounded-2xl transition-all transform hover:scale-105 hover:-translate-y-2 animate-bounce-in" style="animation-delay: 1.5s;">
            <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <i class="fas fa-trophy text-white"></i>
            </div>
            <h4 class="font-semibold text-white mb-1">QA Achievement</h4>
            <p class="text-gray-400 text-sm">Add testing milestone</p>
        </a>

        <a href="{{ route('admin.settings') }}" class="group p-6 glass-effect hover:bg-white/10 rounded-2xl transition-all transform hover:scale-105 hover:-translate-y-2 animate-bounce-in" style="animation-delay: 1.6s;">
            <div class="w-12 h-12 bg-gradient-to-br from-gray-500 to-gray-600 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <i class="fas fa-sliders-h text-white"></i>
            </div>
            <h4 class="font-semibold text-white mb-1">Settings</h4>
            <p class="text-gray-400 text-sm">Manage profile & site</p>
        </a>
    </div>
</div>
@endsection