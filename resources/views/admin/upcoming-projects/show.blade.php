@extends('admin.layout')

@section('title', 'View Lab Project')
@section('page-title', $upcomingProject->title)
@section('page-description', 'Project development details and progress')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-white mb-2">{{ $upcomingProject->title }}</h1>
                <span class="px-3 py-1 text-sm rounded {{ $upcomingProject->status_badge }}">
                    {{ ucfirst(str_replace('_', ' ', $upcomingProject->status)) }}
                </span>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('admin.upcoming-projects.edit', $upcomingProject) }}" class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg transition-colors">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <a href="{{ route('admin.upcoming-projects.index') }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>Back
                </a>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Description</h3>
                <p class="text-gray-300 mb-6">{{ $upcomingProject->description }}</p>

                <h3 class="text-lg font-semibold text-white mb-4">Tech Stack</h3>
                <div class="flex flex-wrap gap-2 mb-6">
                    @foreach($upcomingProject->tech_stack_array as $tech)
                    <span class="px-3 py-1 bg-primary-500/20 text-primary-400 rounded-full text-sm">
                        {{ trim($tech) }}
                    </span>
                    @endforeach
                </div>

                @if($upcomingProject->current_phase)
                <h3 class="text-lg font-semibold text-white mb-4">Current Phase</h3>
                <p class="text-blue-300 mb-6">{{ $upcomingProject->current_phase }}</p>
                @endif

                @if($upcomingProject->milestones)
                <h3 class="text-lg font-semibold text-white mb-4">Milestones</h3>
                <ul class="space-y-2 mb-6">
                    @foreach($upcomingProject->milestones as $milestone)
                    <li class="flex items-center text-gray-300">
                        <i class="fas fa-circle text-xs text-gray-500 mr-3"></i>
                        {{ $milestone }}
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>

            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Progress</h3>
                <div class="mb-6">
                    <div class="flex justify-between text-sm text-gray-400 mb-2">
                        <span>Completion</span>
                        <span>{{ $upcomingProject->progress_percentage }}%</span>
                    </div>
                    <div class="w-full bg-gray-600 rounded-full h-4">
                        <div class="bg-{{ $upcomingProject->progress_color }}-500 h-4 rounded-full transition-all duration-300" 
                             style="width: {{ $upcomingProject->progress_percentage }}%"></div>
                    </div>
                </div>

                <h3 class="text-lg font-semibold text-white mb-4">Project Timeline</h3>
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Expected Completion:</span>
                        <span class="text-white font-medium">{{ $upcomingProject->expected_completion->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Days Remaining:</span>
                        <span class="text-white font-medium">
                            @if($upcomingProject->expected_completion->isFuture())
                                {{ $upcomingProject->expected_completion->diffInDays(now()) }} days
                            @else
                                <span class="text-red-400">Overdue by {{ now()->diffInDays($upcomingProject->expected_completion) }} days</span>
                            @endif
                        </span>
                    </div>
                </div>

                <h3 class="text-lg font-semibold text-white mb-4">Project Info</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Status:</span>
                        <span class="text-white">{{ ucfirst(str_replace('_', ' ', $upcomingProject->status)) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Active:</span>
                        <span class="text-white">{{ $upcomingProject->is_active ? 'Yes' : 'No' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Created:</span>
                        <span class="text-white">{{ $upcomingProject->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Updated:</span>
                        <span class="text-white">{{ $upcomingProject->updated_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection