@extends('admin.layout')

@section('title', 'Edit Project')
@section('page-title', 'Edit Project')
@section('page-description', 'Update project information')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Title -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Project Title *</label>
                    <input type="text" name="title" value="{{ old('title', $project->title) }}" required 
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400">
                    @error('title')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Sort Order -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $project->sort_order) }}" 
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400">
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Description *</label>
                <textarea name="description" rows="4" required 
                          class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400">{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tech Stack -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Tech Stack *</label>
                <input type="text" name="tech_stack" value="{{ old('tech_stack', $project->tech_stack) }}" required 
                       class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400">
                @error('tech_stack')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- GitHub Link -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">GitHub Link</label>
                    <input type="url" name="github_link" value="{{ old('github_link', $project->github_link) }}" 
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400">
                    @error('github_link')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Live Link -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Live Demo Link</label>
                    <input type="url" name="live_link" value="{{ old('live_link', $project->live_link) }}" 
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400">
                    @error('live_link')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Current Image -->
            @if($project->image)
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Current Image</label>
                <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-32 h-32 object-cover rounded-lg">
            </div>
            @endif

            <!-- Project Image -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Project Image</label>
                <input type="file" name="image" accept="image/*" 
                       class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white">
                @error('image')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status Options -->
            <div class="grid md:grid-cols-2 gap-6">
                <div class="flex items-center">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}
                           class="w-4 h-4 text-primary-600 bg-gray-700 border-gray-600 rounded focus:ring-primary-500">
                    <label class="ml-2 text-sm text-gray-300">Featured Project</label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $project->is_active) ? 'checked' : '' }}
                           class="w-4 h-4 text-primary-600 bg-gray-700 border-gray-600 rounded focus:ring-primary-500">
                    <label class="ml-2 text-sm text-gray-300">Active (Visible on site)</label>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-700">
                <a href="{{ route('admin.projects.show', $project) }}" class="px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-colors">
                    <i class="fas fa-save mr-2"></i>Update Project
                </button>
            </div>
        </form>
    </div>
</div>
@endsection