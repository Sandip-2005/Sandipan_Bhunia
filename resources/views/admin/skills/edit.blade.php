@extends('admin.layout')

@section('title', 'Edit Skill')
@section('page-title', 'Edit Skill')
@section('page-description', 'Update skill information and proficiency')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
        <form action="{{ route('admin.skills.update', $skill) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Skill Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Skill Name *</label>
                    <input type="text" name="name" value="{{ old('name', $skill->name) }}" required 
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400">
                    @error('name')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Category *</label>
                    <select name="category" required 
                            class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white">
                        <option value="frontend" {{ old('category', $skill->category) == 'frontend' ? 'selected' : '' }}>Frontend</option>
                        <option value="backend" {{ old('category', $skill->category) == 'backend' ? 'selected' : '' }}>Backend</option>
                        <option value="database" {{ old('category', $skill->category) == 'database' ? 'selected' : '' }}>Database</option>
                        <option value="tools" {{ old('category', $skill->category) == 'tools' ? 'selected' : '' }}>Tools</option>
                        <option value="qa" {{ old('category', $skill->category) == 'qa' ? 'selected' : '' }}>QA/Testing</option>
                        <option value="other" {{ old('category', $skill->category) == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('category')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Proficiency Level -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Proficiency Level *</label>
                    <select name="proficiency_level" required 
                            class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white">
                        <option value="1" {{ old('proficiency_level', $skill->proficiency_level) == '1' ? 'selected' : '' }}>1 - Beginner</option>
                        <option value="2" {{ old('proficiency_level', $skill->proficiency_level) == '2' ? 'selected' : '' }}>2 - Basic</option>
                        <option value="3" {{ old('proficiency_level', $skill->proficiency_level) == '3' ? 'selected' : '' }}>3 - Intermediate</option>
                        <option value="4" {{ old('proficiency_level', $skill->proficiency_level) == '4' ? 'selected' : '' }}>4 - Advanced</option>
                        <option value="5" {{ old('proficiency_level', $skill->proficiency_level) == '5' ? 'selected' : '' }}>5 - Expert</option>
                    </select>
                    @error('proficiency_level')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Icon -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Icon (Emoji)</label>
                    <input type="text" name="icon" value="{{ old('icon', $skill->icon) }}" maxlength="10"
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400">
                    @error('icon')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                <textarea name="description" rows="3" 
                          class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400">{{ old('description', $skill->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Experience and Projects Overrides -->
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Experience Override Text</label>
                    <input type="text" name="experience_text" value="{{ old('experience_text', $skill->experience_text) }}"
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400"
                           placeholder="e.g., '3+ Years Experience' (Optional)">
                    <p class="mt-1 text-sm text-gray-400">Leaves default based on proficiency if left blank.</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Projects Override Text</label>
                    <input type="text" name="projects_text" value="{{ old('projects_text', $skill->projects_text) }}"
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400"
                           placeholder="e.g., '10+ Projects' (Optional)">
                    <p class="mt-1 text-sm text-gray-400">Leaves default based on proficiency if left blank.</p>
                </div>
            </div>

            <!-- Sort Order -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $skill->sort_order) }}" 
                       class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400">
                @error('sort_order')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status Options -->
            <div class="grid md:grid-cols-2 gap-6">
                <div class="flex items-center">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $skill->is_featured) ? 'checked' : '' }}
                           class="w-4 h-4 text-primary-600 bg-gray-700 border-gray-600 rounded focus:ring-primary-500">
                    <label class="ml-2 text-sm text-gray-300">Featured Skill</label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $skill->is_active) ? 'checked' : '' }}
                           class="w-4 h-4 text-primary-600 bg-gray-700 border-gray-600 rounded focus:ring-primary-500">
                    <label class="ml-2 text-sm text-gray-300">Active (Visible on site)</label>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-700">
                <a href="{{ route('admin.skills.show', $skill) }}" class="px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-colors">
                    <i class="fas fa-save mr-2"></i>Update Skill
                </button>
            </div>
        </form>
    </div>
</div>
@endsection