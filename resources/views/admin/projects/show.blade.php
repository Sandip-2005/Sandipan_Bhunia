@extends('admin.layout')

@section('title', 'View Project')
@section('page-title', $project->title)
@section('page-description', 'Project details and information')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden">
        @if($project->image)
        <div class="h-64 bg-gray-700">
            <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
        </div>
        @endif
        
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-white mb-2">{{ $project->title }}</h1>
                    <div class="flex items-center space-x-4">
                        @if($project->is_featured)
                            <span class="px-3 py-1 bg-yellow-500/20 text-yellow-400 text-sm rounded-full">Featured</span>
                        @endif
                        @if($project->is_active)
                            <span class="px-3 py-1 bg-green-500/20 text-green-400 text-sm rounded-full">Active</span>
                        @else
                            <span class="px-3 py-1 bg-gray-500/20 text-gray-400 text-sm rounded-full">Inactive</span>
                        @endif
                    </div>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.projects.edit', $project) }}" class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg transition-colors">
                        <i class="fas fa-edit mr-2"></i>Edit
                    </a>
                    <a href="{{ route('admin.projects.index') }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>Back
                    </a>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Description</h3>
                    <p class="text-gray-300 mb-6">{{ $project->description }}</p>

                    <h3 class="text-lg font-semibold text-white mb-4">Tech Stack</h3>
                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach($project->tech_stack_array as $tech)
                        <span class="px-3 py-1 bg-primary-500/20 text-primary-400 rounded-full text-sm">
                            {{ trim($tech) }}
                        </span>
                        @endforeach
                    </div>

                    @if($project->features)
                    <h3 class="text-lg font-semibold text-white mb-4">Key Features</h3>
                    <ul class="space-y-2 mb-6">
                        @foreach($project->features as $feature)
                        <li class="flex items-center text-gray-300">
                            <i class="fas fa-check text-green-400 mr-2"></i>
                            {{ $feature }}
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Project Links</h3>
                    <div class="space-y-3 mb-6">
                        @if($project->github_link)
                        <a href="{{ $project->github_link }}" target="_blank" class="flex items-center p-3 bg-gray-700 hover:bg-gray-600 rounded-lg transition-colors">
                            <i class="fab fa-github text-xl mr-3"></i>
                            <div>
                                <div class="text-white font-medium">GitHub Repository</div>
                                <div class="text-gray-400 text-sm">View source code</div>
                            </div>
                        </a>
                        @endif

                        @if($project->live_link)
                        <a href="{{ $project->live_link }}" target="_blank" class="flex items-center p-3 bg-gray-700 hover:bg-gray-600 rounded-lg transition-colors">
                            <i class="fas fa-external-link-alt text-xl mr-3"></i>
                            <div>
                                <div class="text-white font-medium">Live Demo</div>
                                <div class="text-gray-400 text-sm">View live project</div>
                            </div>
                        </a>
                        @endif
                    </div>

                    <h3 class="text-lg font-semibold text-white mb-4">Project Info</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Sort Order:</span>
                            <span class="text-white">{{ $project->sort_order }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Created:</span>
                            <span class="text-white">{{ $project->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Updated:</span>
                            <span class="text-white">{{ $project->updated_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection