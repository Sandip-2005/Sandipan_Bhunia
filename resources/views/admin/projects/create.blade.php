@extends('admin.layout')

@section('title', 'Create Project')
@section('page-title', 'Create Project')
@section('page-description', 'Add a new completed project to your portfolio')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Title -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Project Title *</label>
                    <input type="text" name="title" value="{{ old('title') }}" required 
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400"
                           placeholder="Enter project title">
                    @error('title')
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

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Description *</label>
                <textarea name="description" rows="4" required 
                          class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400"
                          placeholder="Describe your project...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tech Stack -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Tech Stack *</label>
                <input type="text" name="tech_stack" value="{{ old('tech_stack') }}" required 
                       class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400"
                       placeholder="PHP, Laravel, MySQL, JavaScript (comma separated)">
                <p class="mt-1 text-sm text-gray-400">Separate technologies with commas</p>
                @error('tech_stack')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- GitHub Link -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">GitHub Link</label>
                    <input type="url" name="github_link" value="{{ old('github_link') }}" 
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400"
                           placeholder="https://github.com/username/project">
                    @error('github_link')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Live Link -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Live Demo Link</label>
                    <input type="url" name="live_link" value="{{ old('live_link') }}" 
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400"
                           placeholder="https://your-project.com">
                    @error('live_link')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Project Image -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Project Image</label>
                <div class="flex items-center justify-center w-full">
                    <label for="image" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-600 border-dashed rounded-lg cursor-pointer bg-gray-700 hover:bg-gray-600">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                            <p class="mb-2 text-sm text-gray-400">
                                <span class="font-semibold">Click to upload</span> or drag and drop
                            </p>
                            <p class="text-xs text-gray-400">PNG, JPG, GIF up to 2MB</p>
                        </div>
                        <input id="image" name="image" type="file" class="hidden" accept="image/*" onchange="previewImage(this)">
                    </label>
                </div>
                <div id="image-preview" class="mt-4 hidden">
                    <img id="preview-img" class="w-full h-64 object-cover rounded-lg" alt="Preview">
                </div>
                @error('image')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Features -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Key Features</label>
                <div id="features-container">
                    <div class="flex items-center space-x-2 mb-2">
                        <input type="text" name="features[]" 
                               class="flex-1 px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400"
                               placeholder="Enter a key feature">
                        <button type="button" onclick="removeFeature(this)" class="px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <button type="button" onclick="addFeature()" class="mt-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg">
                    <i class="fas fa-plus mr-2"></i>Add Feature
                </button>
            </div>

            <!-- Status Options -->
            <div class="grid md:grid-cols-2 gap-6">
                <div class="flex items-center">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                           class="w-4 h-4 text-primary-600 bg-gray-700 border-gray-600 rounded focus:ring-primary-500">
                    <label class="ml-2 text-sm text-gray-300">Featured Project</label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                           class="w-4 h-4 text-primary-600 bg-gray-700 border-gray-600 rounded focus:ring-primary-500">
                    <label class="ml-2 text-sm text-gray-300">Active (Visible on site)</label>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-700">
                <a href="{{ route('admin.projects.index') }}" class="px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-colors">
                    <i class="fas fa-save mr-2"></i>Create Project
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('image-preview').classList.remove('hidden');
            document.getElementById('preview-img').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function addFeature() {
    const container = document.getElementById('features-container');
    const div = document.createElement('div');
    div.className = 'flex items-center space-x-2 mb-2';
    div.innerHTML = `
        <input type="text" name="features[]" 
               class="flex-1 px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-white placeholder-gray-400"
               placeholder="Enter a key feature">
        <button type="button" onclick="removeFeature(this)" class="px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">
            <i class="fas fa-minus"></i>
        </button>
    `;
    container.appendChild(div);
}

function removeFeature(button) {
    button.parentElement.remove();
}
</script>
@endpush
@endsection