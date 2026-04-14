@extends('admin.layout')

@section('title', 'Settings')
@section('page-title', 'Settings')
@section('page-description', 'Manage your portfolio settings and profile information')

@section('content')
<div class="row g-4">
    <!-- Profile Photo Section -->
    <div class="col-lg-4">
        <div class="bg-gray-800 rounded-lg border border-gray-700 p-4">
            <h6 class="text-white mb-3">Profile Photo</h6>
            
            <!-- Current Photo Display -->
            <div class="text-center mb-4">
                <div class="position-relative d-inline-block">
                    <img id="currentPhoto" 
                         src="{{ isset($settings['profile']) && $settings['profile']->where('key', 'profile_photo')->first() ? asset('uploads/profile/' . $settings['profile']->where('key', 'profile_photo')->first()->value) : 'https://via.placeholder.com/150x150/374151/9CA3AF?text=No+Photo' }}" 
                         alt="Profile Photo" 
                         class="rounded-circle border border-gray-600"
                         style="width: 120px; height: 120px; object-fit: cover;">
                    <div class="position-absolute bottom-0 end-0">
                        <button type="button" class="btn btn-primary btn-sm rounded-circle" onclick="document.getElementById('photoInput').click()">
                            <i class="fas fa-camera"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Upload Form -->
            <form id="photoUploadForm" enctype="multipart/form-data">
                @csrf
                <input type="file" id="photoInput" name="profile_photo" accept="image/*" class="d-none" onchange="uploadPhoto()">
                <div class="text-center">
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="document.getElementById('photoInput').click()">
                        <i class="fas fa-upload me-1"></i>
                        Change Photo
                    </button>
                </div>
            </form>
            
            <div class="mt-3">
                <small class="text-gray-400">
                    <i class="fas fa-info-circle me-1"></i>
                    Recommended: 400x400px, max 2MB
                </small>
            </div>
        </div>
    </div>
    
    <!-- General Settings -->
    <div class="col-lg-8">
        <div class="bg-gray-800 rounded-lg border border-gray-700 p-4">
            <h6 class="text-white mb-4">General Settings</h6>
            
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                
                <div class="row g-3">
                    <!-- Site Information -->
                    <div class="col-12">
                        <h6 class="text-gray-300 mb-3">Site Information</h6>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label text-gray-300">Site Title</label>
                        <input type="text" name="settings[site_title]" class="form-control bg-gray-700 border-gray-600 text-white" 
                               value="{{ isset($settings['general']) && $settings['general']->where('key', 'site_title')->first() ? $settings['general']->where('key', 'site_title')->first()->value : 'Sandipan Bhunia - Full Stack Developer' }}" 
                               placeholder="Your site title">
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label text-gray-300">Site Tagline</label>
                        <input type="text" name="settings[site_tagline]" class="form-control bg-gray-700 border-gray-600 text-white" 
                               value="{{ isset($settings['general']) && $settings['general']->where('key', 'site_tagline')->first() ? $settings['general']->where('key', 'site_tagline')->first()->value : 'Full Stack Developer & QA Engineer' }}" 
                               placeholder="Your tagline">
                    </div>
                    
                    <div class="col-12">
                        <label class="form-label text-gray-300">Site Description</label>
                        <textarea name="settings[site_description]" class="form-control bg-gray-700 border-gray-600 text-white" rows="3" 
                                  placeholder="Brief description of your portfolio">{{ isset($settings['general']) && $settings['general']->where('key', 'site_description')->first() ? $settings['general']->where('key', 'site_description')->first()->value : 'Passionate full-stack developer skilled in PHP, Laravel, MySQL, and modern web technologies.' }}</textarea>
                    </div>
                    
                    <!-- Contact Information -->
                    <div class="col-12 mt-4">
                        <h6 class="text-gray-300 mb-3">Contact Information</h6>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label text-gray-300">Email</label>
                        <input type="email" name="settings[email]" class="form-control bg-gray-700 border-gray-600 text-white" 
                               value="{{ isset($settings['contact']) && $settings['contact']->where('key', 'email')->first() ? $settings['contact']->where('key', 'email')->first()->value : 'sandipanbhunia18@gmail.com' }}" 
                               placeholder="your@email.com">
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label text-gray-300">Phone</label>
                        <input type="text" name="settings[phone]" class="form-control bg-gray-700 border-gray-600 text-white" 
                               value="{{ isset($settings['contact']) && $settings['contact']->where('key', 'phone')->first() ? $settings['contact']->where('key', 'phone')->first()->value : '+91 8972966158' }}" 
                               placeholder="+91 1234567890">
                    </div>
                    
                    <div class="col-12">
                        <label class="form-label text-gray-300">Location</label>
                        <input type="text" name="settings[location]" class="form-control bg-gray-700 border-gray-600 text-white" 
                               value="{{ isset($settings['contact']) && $settings['contact']->where('key', 'location')->first() ? $settings['contact']->where('key', 'location')->first()->value : 'Chaltatalya, Khejuri, Purba Medinipur, 721431, West Bengal, India' }}" 
                               placeholder="Your location">
                    </div>
                    
                    <!-- Social Links -->
                    <div class="col-12 mt-4">
                        <h6 class="text-gray-300 mb-3">Social Links</h6>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label text-gray-300">GitHub URL</label>
                        <input type="url" name="settings[github]" class="form-control bg-gray-700 border-gray-600 text-white" 
                               value="{{ isset($settings['social']) && $settings['social']->where('key', 'github')->first() ? $settings['social']->where('key', 'github')->first()->value : '' }}" 
                               placeholder="https://github.com/yourusername">
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label text-gray-300">LinkedIn URL</label>
                        <input type="url" name="settings[linkedin]" class="form-control bg-gray-700 border-gray-600 text-white" 
                               value="{{ isset($settings['social']) && $settings['social']->where('key', 'linkedin')->first() ? $settings['social']->where('key', 'linkedin')->first()->value : '' }}" 
                               placeholder="https://linkedin.com/in/yourusername">
                    </div>
                    
                    <!-- About Section -->
                    <div class="col-12 mt-4">
                        <h6 class="text-gray-300 mb-3">About Section</h6>
                    </div>
                    
                    <div class="col-12">
                        <label class="form-label text-gray-300">About Me</label>
                        <textarea name="settings[about_me]" class="form-control bg-gray-700 border-gray-600 text-white" rows="4" 
                                  placeholder="Tell visitors about yourself">{{ isset($settings['about']) && $settings['about']->where('key', 'about_me')->first() ? $settings['about']->where('key', 'about_me')->first()->value : 'Passionate full-stack developer with expertise in Laravel, PHP, and modern web technologies. Currently pursuing BCA and specializing in quality assurance and testing methodologies.' }}</textarea>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label text-gray-300">Years of Experience</label>
                        <input type="number" name="settings[experience_years]" class="form-control bg-gray-700 border-gray-600 text-white" 
                               value="{{ isset($settings['about']) && $settings['about']->where('key', 'experience_years')->first() ? $settings['about']->where('key', 'experience_years')->first()->value : '2' }}" 
                               placeholder="2">
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label text-gray-300">Education</label>
                        <input type="text" name="settings[education]" class="form-control bg-gray-700 border-gray-600 text-white" 
                               value="{{ isset($settings['about']) && $settings['about']->where('key', 'education')->first() ? $settings['about']->where('key', 'education')->first()->value : 'BCA Student (2023-2026) - MAKAUT' }}" 
                               placeholder="Your education">
                    </div>
                </div>
                
                <div class="mt-4 pt-3 border-top border-gray-700">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>
                        Save Settings
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary ms-2">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function uploadPhoto() {
    const form = document.getElementById('photoUploadForm');
    const formData = new FormData(form);
    const photoInput = document.getElementById('photoInput');
    
    if (!photoInput.files[0]) return;
    
    // Show loading state
    const currentPhoto = document.getElementById('currentPhoto');
    const originalSrc = currentPhoto.src;
    
    fetch('{{ route("admin.upload.profile") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            currentPhoto.src = data.photo_url;
            
            // Show success message
            const alert = document.createElement('div');
            alert.className = 'alert alert-success alert-dismissible fade show mt-3';
            alert.innerHTML = `
                <i class="fas fa-check-circle me-1"></i>
                ${data.message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            form.parentNode.appendChild(alert);
            
            // Auto dismiss after 3 seconds
            setTimeout(() => {
                if (alert.parentNode) {
                    alert.remove();
                }
            }, 3000);
        } else {
            alert('Error: ' + data.message);
            currentPhoto.src = originalSrc;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while uploading the photo.');
        currentPhoto.src = originalSrc;
    });
}
</script>
@endsection