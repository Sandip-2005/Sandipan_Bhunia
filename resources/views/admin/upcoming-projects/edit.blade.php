@extends('admin.layout')

@section('title', 'Edit Lab Project')
@section('page-title', 'Edit Lab Project')
@section('page-description', 'Update project development information')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
        <form action="{{ route('admin.upcoming-projects.update', $upcomingProject) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Title -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Project Title *</label>
                <input type="text" name="title" value="{{ old('title', $upcomingProject->title) }}" required 
                       class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400">
                @error('title')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Description *</label>
                <textarea name="description" rows="4" required 
                          class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400">{{ old('description', $upcomingProject->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tech Stack -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Tech Stack *</label>
                <input type="text" name="tech_stack" value="{{ old('tech_stack', $upcomingProject->tech_stack) }}" required 
                       class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400">
                @error('tech_stack')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <!-- Progress Percentage -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Progress Percentage *</label>
                    <input type="number" name="progress_percentage" value="{{ old('progress_percentage', $upcomingProject->progress_percentage) }}" 
                           min="0" max="100" required 
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400">
                    @error('progress_percentage')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Status *</label>
                    <select name="status" required 
                            class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white">
                        <option value="planning" {{ old('status', $upcomingProject->status) == 'planning' ? 'selected' : '' }}>Planning</option>
                        <option value="in_progress" {{ old('status', $upcomingProject->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="testing" {{ old('status', $upcomingProject->status) == 'testing' ? 'selected' : '' }}>Testing</option>
                        <option value="delayed" {{ old('status', $upcomingProject->status) == 'delayed' ? 'selected' : '' }}>Delayed</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Expected Completion -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Expected Completion *</label>
                    <input type="date" name="expected_completion" value="{{ old('expected_completion', $upcomingProject->expected_completion->format('Y-m-d')) }}" required 
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white">
                    @error('expected_completion')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Current Phase -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Current Phase</label>
                <input type="text" name="current_phase" value="{{ old('current_phase', $upcomingProject->current_phase) }}" 
                       class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400">
                @error('current_phase')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Milestones -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Milestones</label>
                <div id="milestones-container">
                    @if($upcomingProject->milestones)
                        @foreach($upcomingProject->milestones as $milestone)
                        <div class="flex items-center space-x-2 mb-2">
                            <input type="text" name="milestones[]" value="{{ $milestone }}"
                                   class="flex-1 px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400">
                            <button type="button" onclick="removeMilestone(this)" class="px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                        @endforeach
                    @else
                        <div class="flex items-center space-x-2 mb-2">
                            <input type="text" name="milestones[]" 
                                   class="flex-1 px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400"
                                   placeholder="Enter a milestone">
                            <button type="button" onclick="removeMilestone(this)" class="px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    @endif
                </div>
                <button type="button" onclick="addMilestone()" class="mt-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg">
                    <i class="fas fa-plus mr-2"></i>Add Milestone
                </button>
            </div>

            <!-- Active Status -->
            <div class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $upcomingProject->is_active) ? 'checked' : '' }}
                       class="w-4 h-4 text-primary-600 bg-gray-700 border-gray-600 rounded focus:ring-primary-500">
                <label class="ml-2 text-sm text-gray-300">Active (Visible on site)</label>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-700">
                <a href="{{ route('admin.upcoming-projects.show', $upcomingProject) }}" class="px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-colors">
                    <i class="fas fa-save mr-2"></i>Update Project
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function addMilestone() {
    const container = document.getElementById('milestones-container');
    const div = document.createElement('div');
    div.className = 'flex items-center space-x-2 mb-2';
    div.innerHTML = `
        <input type="text" name="milestones[]" 
               class="flex-1 px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400"
               placeholder="Enter a milestone">
        <button type="button" onclick="removeMilestone(this)" class="px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">
            <i class="fas fa-minus"></i>
        </button>
    `;
    container.appendChild(div);
}

function removeMilestone(button) {
    button.parentElement.remove();
}
</script>
@endpush
@endsection