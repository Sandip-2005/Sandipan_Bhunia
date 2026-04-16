@extends('admin.layout')

@section('title', 'Settings')
@section('page-title', 'Settings')
@section('page-description', 'Manage your portfolio settings and profile information')

@section('content')
<div class="grid lg:grid-cols-3 gap-6">
    <!-- Profile Photo Section - COMPACT -->
    <div class="lg:col-span-1">
        <div class="glass-effect rounded-xl p-6 animate-fade-in">
            <h3 class="text-lg font-bold text-white mb-4 flex items-center">
                <div class="w-6 h-6 bg-blue-500/20 rounded-lg flex items-center justify-center mr-2">
                    <i class="fas fa-user text-blue-400 text-sm"></i>
                </div>
                Profile Photo
            </h3>
            
            <!-- Current Photo Display - COMPACT -->
            <div class="text-center mb-4">
                <div class="relative inline-block">
                    <img id="currentPhoto" 
                         src="{{ isset($settings['profile']) && $settings['profile']->where('key', 'profile_photo')->first() ? asset('uploads/profile/' . $settings['profile']->where('key', 'profile_photo')->first()->value) : asset('images/default-avatar.svg') }}" 
                         onerror="this.onerror=null; this.src='{{ asset('images/default-avatar.svg') }}';"
                         alt="Profile Photo" 
                         class="w-24 h-24 rounded-xl object-cover border-2 border-white/20 shadow-lg">
                    <div class="absolute -bottom-1 -right-1">
                        <button type="button" class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-500 rounded-lg flex items-center justify-center text-white text-xs hover:scale-110 transition-transform" onclick="document.getElementById('photoInput').click()">
                            <i class="fas fa-camera"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Upload Form - COMPACT -->
            <form id="photoUploadForm" enctype="multipart/form-data">
                @csrf
                <input type="file" id="photoInput" name="profile_photo" accept="image/*" class="hidden" onchange="uploadPhoto()">
                <div class="text-center">
                    <button type="button" class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-lg transition-all text-sm font-medium" onclick="document.getElementById('photoInput').click()">
                        <i class="fas fa-upload mr-2"></i>
                        Change Photo
                    </button>
                </div>
            </form>
            
            <div class="mt-3 text-center">
                <small class="text-gray-400 text-xs">
                    <i class="fas fa-info-circle mr-1"></i>
                    400x400px, max 2MB
                </small>
            </div>
        </div> <!-- Close glass-effect -->
    <!-- (CV upload moved to dedicated CVs management page) -->
    </div> <!-- Close lg:col-span-1 -->
    
    <!-- General Settings - COMPACT -->
    <div class="lg:col-span-2">
        <div class="glass-effect rounded-xl p-6 animate-fade-in" style="animation-delay: 0.1s;">
            <h3 class="text-lg font-bold text-white mb-6 flex items-center">
                <div class="w-6 h-6 bg-purple-500/20 rounded-lg flex items-center justify-center mr-2">
                    <i class="fas fa-cog text-purple-400 text-sm"></i>
                </div>
                General Settings
            </h3>
            
            <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Site Information - COMPACT -->
                <div>
                    <h4 class="text-md font-semibold text-white mb-3 flex items-center">
                        <i class="fas fa-globe text-blue-400 mr-2 text-sm"></i>
                        Site Information
                    </h4>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Site Title</label>
                            <input type="text" name="settings[site_title]" class="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500" 
                                   value="{{ isset($settings['general']) && $settings['general']->where('key', 'site_title')->first() ? $settings['general']->where('key', 'site_title')->first()->value : 'Sandipan Bhunia - Full Stack Developer' }}" 
                                   placeholder="Your site title">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Site Tagline</label>
                            <input type="text" name="settings[site_tagline]" class="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500" 
                                   value="{{ isset($settings['general']) && $settings['general']->where('key', 'site_tagline')->first() ? $settings['general']->where('key', 'site_tagline')->first()->value : 'Full Stack Developer & QA Engineer' }}" 
                                   placeholder="Your tagline">
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-300 mb-1">Site Description</label>
                            <textarea name="settings[site_description]" class="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500" rows="2" 
                                      placeholder="Brief description of your portfolio">{{ isset($settings['general']) && $settings['general']->where('key', 'site_description')->first() ? $settings['general']->where('key', 'site_description')->first()->value : 'Passionate full-stack developer skilled in PHP, Laravel, MySQL, and modern web technologies.' }}</textarea>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Information - COMPACT -->
                <div>
                    <h4 class="text-md font-semibold text-white mb-3 flex items-center">
                        <i class="fas fa-envelope text-green-400 mr-2 text-sm"></i>
                        Contact Information
                    </h4>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                            <input type="email" name="settings[email]" class="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:border-green-500 focus:ring-1 focus:ring-green-500" 
                                   value="{{ isset($settings['contact']) && $settings['contact']->where('key', 'email')->first() ? $settings['contact']->where('key', 'email')->first()->value : 'sandipanbhunia18@gmail.com' }}" 
                                   placeholder="your@email.com">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Phone</label>
                            <input type="text" name="settings[phone]" class="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:border-green-500 focus:ring-1 focus:ring-green-500" 
                                   value="{{ isset($settings['contact']) && $settings['contact']->where('key', 'phone')->first() ? $settings['contact']->where('key', 'phone')->first()->value : '+91 8972966158' }}" 
                                   placeholder="+91 1234567890">
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-300 mb-1">Location</label>
                            <input type="text" name="settings[location]" class="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:border-green-500 focus:ring-1 focus:ring-green-500" 
                                   value="{{ isset($settings['contact']) && $settings['contact']->where('key', 'location')->first() ? $settings['contact']->where('key', 'location')->first()->value : 'Chaltatalya, Khejuri, Purba Medinipur, 721431, West Bengal, India' }}" 
                                   placeholder="Your location">
                        </div>
                    </div>
                </div>
                
                <!-- Social Links - COMPACT -->
                <div>
                    <h4 class="text-md font-semibold text-white mb-3 flex items-center">
                        <i class="fas fa-share-alt text-purple-400 mr-2 text-sm"></i>
                        Social Links
                    </h4>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">GitHub URL</label>
                            <input type="url" name="settings[github]" class="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:border-purple-500 focus:ring-1 focus:ring-purple-500" 
                                   value="{{ isset($settings['social']) && $settings['social']->where('key', 'github')->first() ? $settings['social']->where('key', 'github')->first()->value : '' }}" 
                                   placeholder="https://github.com/yourusername">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">LinkedIn URL</label>
                            <input type="url" name="settings[linkedin]" class="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:border-purple-500 focus:ring-1 focus:ring-purple-500" 
                                   value="{{ isset($settings['social']) && $settings['social']->where('key', 'linkedin')->first() ? $settings['social']->where('key', 'linkedin')->first()->value : '' }}" 
                                   placeholder="https://linkedin.com/in/yourusername">
                        </div>
                    </div>
                </div>
                
                <!-- About Section - COMPACT -->
                <div>
                    <h4 class="text-md font-semibold text-white mb-3 flex items-center">
                        <i class="fas fa-user text-yellow-400 mr-2 text-sm"></i>
                        About Section
                    </h4>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">About Me</label>
                            <textarea name="settings[about_me]" class="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500" rows="3" 
                                      placeholder="Tell visitors about yourself">{{ isset($settings['about']) && $settings['about']->where('key', 'about_me')->first() ? $settings['about']->where('key', 'about_me')->first()->value : 'Passionate full-stack developer with expertise in Laravel, PHP, and modern web technologies. Currently pursuing BCA and specializing in quality assurance and testing methodologies.' }}</textarea>
                        </div>
                        
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Years of Experience</label>
                                <input type="number" name="settings[experience_years]" class="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500" 
                                       value="{{ isset($settings['about']) && $settings['about']->where('key', 'experience_years')->first() ? $settings['about']->where('key', 'experience_years')->first()->value : '2' }}" 
                                       placeholder="2">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Education</label>
                                <input type="text" name="settings[education]" class="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-lg text-white text-sm focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500" 
                                       value="{{ isset($settings['about']) && $settings['about']->where('key', 'education')->first() ? $settings['about']->where('key', 'education')->first()->value : 'BCA Student (2023-2026) - MAKAUT' }}" 
                                       placeholder="Your education">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons - COMPACT -->
                <div class="flex items-center gap-3 pt-4 border-t border-white/10">
                    <button type="submit" class="px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white rounded-lg transition-all transform hover:scale-105 font-medium text-sm">
                        <i class="fas fa-save mr-2"></i>
                        Save Settings
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="px-6 py-2 bg-white/10 hover:bg-white/20 text-white rounded-lg transition-all font-medium text-sm">
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
            Swal.fire({ icon: 'success', title: 'Success!', text: data.message, timer: 3000, showConfirmButton: false, background: '#1f2937', color: '#ffffff' });
        } else {
            Swal.fire({ icon: 'error', title: 'Error!', text: data.message, background: '#1f2937', color: '#ffffff' });
            currentPhoto.src = originalSrc;
        }
    })
    .catch(() => {
        Swal.fire({ icon: 'error', title: 'Error!', text: 'An error occurred.', background: '#1f2937', color: '#ffffff' });
        currentPhoto.src = originalSrc;
    });
}

</script>
@endsection