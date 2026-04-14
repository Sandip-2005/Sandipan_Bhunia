@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-description', 'Overview of your portfolio content and analytics')

@section('content')
<!-- Visit Statistics Cards -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="bg-gray-800 rounded-lg p-3 border border-gray-700">
            <div class="d-flex align-items-center">
                <div class="p-2 bg-blue-500/20 rounded-circle me-2">
                    <i class="fas fa-eye text-blue-400"></i>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-400 mb-0">Total Visits</p>
                    <p class="h5 font-bold text-white mb-0">{{ $stats['total_visits'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="bg-gray-800 rounded-lg p-3 border border-gray-700">
            <div class="d-flex align-items-center">
                <div class="p-2 bg-green-500/20 rounded-circle me-2">
                    <i class="fas fa-users text-green-400"></i>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-400 mb-0">Unique Visitors</p>
                    <p class="h5 font-bold text-white mb-0">{{ $stats['unique_visitors'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="bg-gray-800 rounded-lg p-3 border border-gray-700">
            <div class="d-flex align-items-center">
                <div class="p-2 bg-yellow-500/20 rounded-circle me-2">
                    <i class="fas fa-calendar-day text-yellow-400"></i>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-400 mb-0">Today</p>
                    <p class="h5 font-bold text-white mb-0">{{ $stats['today_visits'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="bg-gray-800 rounded-lg p-3 border border-gray-700">
            <div class="d-flex align-items-center">
                <div class="p-2 bg-purple-500/20 rounded-circle me-2">
                    <i class="fas fa-calendar-alt text-purple-400"></i>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-400 mb-0">This Month</p>
                    <p class="h5 font-bold text-white mb-0">{{ $stats['monthly_visits'] }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Statistics Cards -->
<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="bg-gray-800 rounded-lg p-3 border border-gray-700">
            <div class="d-flex align-items-center">
                <div class="p-2 bg-blue-500/20 rounded-circle me-2">
                    <i class="fas fa-project-diagram text-blue-400"></i>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-400 mb-0">Projects</p>
                    <p class="h5 font-bold text-white mb-0">{{ $stats['projects'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="bg-gray-800 rounded-lg p-3 border border-gray-700">
            <div class="d-flex align-items-center">
                <div class="p-2 bg-purple-500/20 rounded-circle me-2">
                    <i class="fas fa-flask text-purple-400"></i>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-400 mb-0">In Lab</p>
                    <p class="h5 font-bold text-white mb-0">{{ $stats['upcoming_projects'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="bg-gray-800 rounded-lg p-3 border border-gray-700">
            <div class="d-flex align-items-center">
                <div class="p-2 bg-green-500/20 rounded-circle me-2">
                    <i class="fas fa-cogs text-green-400"></i>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-400 mb-0">Skills</p>
                    <p class="h5 font-bold text-white mb-0">{{ $stats['skills'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="bg-gray-800 rounded-lg p-3 border border-gray-700">
            <div class="d-flex align-items-center">
                <div class="p-2 bg-red-500/20 rounded-circle me-2">
                    <i class="fas fa-bug text-red-400"></i>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-400 mb-0">QA Achievements</p>
                    <p class="h5 font-bold text-white mb-0">{{ $stats['qa_achievements'] }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Projects -->
    <div class="col-lg-6">
        <div class="bg-gray-800 rounded-lg border border-gray-700">
            <div class="p-3 border-b border-gray-700">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="text-white mb-0">Recent Projects</h6>
                    <a href="{{ route('admin.projects.index') }}" class="text-primary-400 hover:text-primary-300 text-sm">View All</a>
                </div>
            </div>
            <div class="p-3">
                @if($recentProjects->count() > 0)
                    <div class="space-y-3">
                        @foreach($recentProjects as $project)
                        <div class="d-flex align-items-center justify-content-between p-2 bg-gray-700/50 rounded">
                            <div class="flex-grow-1">
                                <h6 class="text-white mb-1 text-sm">{{ $project->title }}</h6>
                                <p class="text-gray-400 mb-0 text-xs">{{ Str::limit($project->description, 40) }}</p>
                                <div class="d-flex gap-1 mt-1">
                                    @if($project->is_featured)
                                        <span class="badge bg-warning text-dark" style="font-size: 0.6rem;">Featured</span>
                                    @endif
                                    @if($project->is_active)
                                        <span class="badge bg-success" style="font-size: 0.6rem;">Active</span>
                                    @endif
                                </div>
                            </div>
                            <div class="text-end">
                                <p class="text-xs text-gray-400 mb-0">{{ $project->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-project-diagram text-4xl text-gray-600 mb-3"></i>
                        <p class="text-gray-400 mb-3">No projects yet</p>
                        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm">
                            Create First Project
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent Lab Projects -->
    <div class="col-lg-6">
        <div class="bg-gray-800 rounded-lg border border-gray-700">
            <div class="p-3 border-b border-gray-700">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="text-white mb-0">In the Lab</h6>
                    <a href="{{ route('admin.upcoming-projects.index') }}" class="text-primary-400 hover:text-primary-300 text-sm">View All</a>
                </div>
            </div>
            <div class="p-3">
                @if($recentUpcoming->count() > 0)
                    <div class="space-y-3">
                        @foreach($recentUpcoming as $project)
                        <div class="p-2 bg-gray-700/50 rounded">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h6 class="text-white mb-0 text-sm">{{ $project->title }}</h6>
                                <span class="badge {{ $project->status == 'in_progress' ? 'bg-warning text-dark' : ($project->status == 'planning' ? 'bg-info' : 'bg-secondary') }}" style="font-size: 0.6rem;">
                                    {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                </span>
                            </div>
                            <p class="text-gray-400 mb-2 text-xs">{{ Str::limit($project->description, 40) }}</p>
                            
                            <!-- Progress Bar -->
                            <div class="mb-2">
                                <div class="d-flex justify-content-between text-xs text-gray-400 mb-1">
                                    <span>Progress</span>
                                    <span>{{ $project->progress_percentage }}%</span>
                                </div>
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-{{ $project->progress_color }}" style="width: {{ $project->progress_percentage }}%"></div>
                                </div>
                            </div>
                            
                            <p class="text-xs text-gray-400 mb-0">
                                <i class="fas fa-calendar-alt me-1"></i>
                                Expected: {{ $project->expected_completion->format('M Y') }}
                            </p>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-flask text-4xl text-gray-600 mb-3"></i>
                        <p class="text-gray-400 mb-3">No lab projects</p>
                        <a href="{{ route('admin.upcoming-projects.create') }}" class="btn btn-primary btn-sm">
                            Add to Lab
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="mt-4">
    <h6 class="text-white mb-3">Quick Actions</h6>
    <div class="row g-2">
        <div class="col-6 col-md-3">
            <a href="{{ route('admin.projects.create') }}" class="d-flex align-items-center p-3 bg-gray-800 hover:bg-gray-700 rounded border border-gray-700 text-decoration-none transition-colors">
                <div class="p-2 bg-blue-500/20 rounded me-3">
                    <i class="fas fa-plus text-blue-400"></i>
                </div>
                <div>
                    <p class="text-white mb-0 text-sm fw-medium">New Project</p>
                    <p class="text-gray-400 mb-0" style="font-size: 0.7rem;">Add completed project</p>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-3">
            <a href="{{ route('admin.upcoming-projects.create') }}" class="d-flex align-items-center p-3 bg-gray-800 hover:bg-gray-700 rounded border border-gray-700 text-decoration-none transition-colors">
                <div class="p-2 bg-purple-500/20 rounded me-3">
                    <i class="fas fa-flask text-purple-400"></i>
                </div>
                <div>
                    <p class="text-white mb-0 text-sm fw-medium">Lab Project</p>
                    <p class="text-gray-400 mb-0" style="font-size: 0.7rem;">Add work in progress</p>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-3">
            <a href="{{ route('admin.skills.create') }}" class="d-flex align-items-center p-3 bg-gray-800 hover:bg-gray-700 rounded border border-gray-700 text-decoration-none transition-colors">
                <div class="p-2 bg-green-500/20 rounded me-3">
                    <i class="fas fa-cog text-green-400"></i>
                </div>
                <div>
                    <p class="text-white mb-0 text-sm fw-medium">New Skill</p>
                    <p class="text-gray-400 mb-0" style="font-size: 0.7rem;">Add technology skill</p>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-3">
            <a href="{{ route('admin.qa-achievements.create') }}" class="d-flex align-items-center p-3 bg-gray-800 hover:bg-gray-700 rounded border border-gray-700 text-decoration-none transition-colors">
                <div class="p-2 bg-red-500/20 rounded me-3">
                    <i class="fas fa-trophy text-red-400"></i>
                </div>
                <div>
                    <p class="text-white mb-0 text-sm fw-medium">QA Achievement</p>
                    <p class="text-gray-400 mb-0" style="font-size: 0.7rem;">Add testing milestone</p>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-3">
            <a href="{{ route('admin.settings') }}" class="d-flex align-items-center p-3 bg-gray-800 hover:bg-gray-700 rounded border border-gray-700 text-decoration-none transition-colors">
                <div class="p-2 bg-gray-500/20 rounded me-3">
                    <i class="fas fa-cog text-gray-400"></i>
                </div>
                <div>
                    <p class="text-white mb-0 text-sm fw-medium">Settings</p>
                    <p class="text-gray-400 mb-0" style="font-size: 0.7rem;">Manage profile & site</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection