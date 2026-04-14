@extends('admin.layout')

@section('title', 'Create QA Achievement')
@section('page-title', 'Create QA Achievement')
@section('page-description', 'Add a new quality assurance achievement or testing milestone')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
        <form action="{{ route('admin.qa-achievements.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Title -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Achievement Title *</label>
                    <input type="text" name="title" value="{{ old('title') }}" required 
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400"
                           placeholder="Enter achievement title">
                    @error('title')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Achievement Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Achievement Type *</label>
                    <select name="achievement_type" required 
                            class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white">
                        <option value="">Select type</option>
                        <option value="bug_found" {{ old('achievement_type') == 'bug_found' ? 'selected' : '' }}>Bug Found</option>
                        <option value="automation_created" {{ old('achievement_type') == 'automation_created' ? 'selected' : '' }}>Automation Created</option>
                        <option value="performance_improved" {{ old('achievement_type') == 'performance_improved' ? 'selected' : '' }}>Performance Improved</option>
                    </select>
                    @error('achievement_type')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Description *</label>
                <textarea name="description" rows="4" required 
                          class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400"
                          placeholder="Describe your achievement in detail...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Tool Used -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Tool Used *</label>
                    <input type="text" name="tool_used" value="{{ old('tool_used') }}" required 
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400"
                           placeholder="e.g., Selenium, Postman, Manual, Jest">
                    @error('tool_used')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Bugs Found -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Bugs Found</label>
                    <input type="number" name="bugs_found" value="{{ old('bugs_found', 0) }}" min="0"
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400"
                           placeholder="0">
                    @error('bugs_found')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Project Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Project Name</label>
                    <input type="text" name="project_name" value="{{ old('project_name') }}" 
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400"
                           placeholder="Project where this was achieved">
                    @error('project_name')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Achievement Date -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Achievement Date *</label>
                    <input type="date" name="achievement_date" value="{{ old('achievement_date') }}" required 
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white">
                    @error('achievement_date')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Impact -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Impact</label>
                <textarea name="impact" rows="3" 
                          class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400"
                          placeholder="Describe the impact of this achievement...">{{ old('impact') }}</textarea>
                @error('impact')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Evidence Link -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Evidence Link</label>
                    <input type="url" name="evidence_link" value="{{ old('evidence_link') }}" 
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400"
                           placeholder="https://link-to-evidence.com">
                    @error('evidence_link')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Sort Order -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" 
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400"
                           placeholder="0">
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Status Options -->
            <div class="grid md:grid-cols-2 gap-6">
                <div class="flex items-center">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                           class="w-4 h-4 text-primary-600 bg-gray-700 border-gray-600 rounded focus:ring-primary-500">
                    <label class="ml-2 text-sm text-gray-300">Featured Achievement</label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                           class="w-4 h-4 text-primary-600 bg-gray-700 border-gray-600 rounded focus:ring-primary-500">
                    <label class="ml-2 text-sm text-gray-300">Active (Visible on site)</label>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-700">
                <a href="{{ route('admin.qa-achievements.index') }}" class="px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-colors">
                    <i class="fas fa-save mr-2"></i>Create Achievement
                </button>
            </div>
        </form>
    </div>
</div>
@endsection