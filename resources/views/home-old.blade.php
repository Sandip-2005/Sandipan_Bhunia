@extends('layout')

@section('content')
<!-- Hero Section -->
<section id="home" class="min-h-screen flex items-center justify-center pt-20">
    <div class="container mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <!-- Hero Content -->
            <div class="text-center lg:text-left" data-aos="fade-right">
                <h1 class="text-5xl lg:text-7xl font-bold text-gray-800 dark:text-white mb-6">
                    {{ $settings['hero_title'] ?? "Hi, I'm Sandipan" }}
                    <span class="block text-primary-600 animate-glow">Bhunia</span>
                </h1>
                <h2 class="text-2xl lg:text-3xl text-gray-600 dark:text-gray-300 mb-6">
                    {{ $settings['hero_subtitle'] ?? 'Full Stack Developer & QA Engineer' }}
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-400 mb-8 max-w-2xl">
                    {{ $settings['hero_description'] ?? 'Passionate about building dynamic web applications, real-time billing systems, and secure dashboards.' }}
                </p>
                
                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="#projects" class="px-8 py-4 bg-primary-600 text-white rounded-full hover:bg-primary-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        View My Work
                    </a>
                    <a href="#contact" class="px-8 py-4 border-2 border-primary-600 text-primary-600 dark:text-primary-400 rounded-full hover:bg-primary-600 hover:text-white transition-all duration-300 transform hover:scale-105">
                        Get In Touch
                    </a>
                </div>
            </div>
            
            <!-- Hero Image/Animation -->
            <div class="flex justify-center lg:justify-end" data-aos="fade-left">
                <div class="relative">
                    <div class="w-80 h-80 bg-gradient-to-br from-primary-400 to-purple-600 rounded-full animate-float opacity-20"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="text-8xl">👨‍💻</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-20 bg-white/50 dark:bg-gray-800/50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl font-bold text-gray-800 dark:text-white mb-4">About Me</h2>
            <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
                A passionate full-stack developer with expertise in modern web technologies and quality assurance.
            </p>
        </div>
        
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Education -->
            <div class="bento-box p-8" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center">
                    <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-graduation-cap text-2xl text-primary-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Education</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Bachelor of Computer Application</p>
                    <p class="text-sm text-gray-500 dark:text-gray-500">Contai College (MAKAUT)</p>
                    <p class="text-sm text-gray-500 dark:text-gray-500">2023 - 2026</p>
                    <p class="text-sm font-semibold text-primary-600 mt-2">SGPA: 8.86, 8.18, 7.43, 7.83</p>
                </div>
            </div>
            
            <!-- Experience -->
            <div class="bento-box p-8" data-aos="fade-up" data-aos-delay="200">
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-code text-2xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Experience</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Full Stack Development</p>
                    <p class="text-sm text-gray-500 dark:text-gray-500">PHP, Laravel, MySQL</p>
                    <p class="text-sm text-gray-500 dark:text-gray-500">Modern Web Technologies</p>
                </div>
            </div>
            
            <!-- Contact Info -->
            <div class="bento-box p-8" data-aos="fade-up" data-aos-delay="300">
                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-map-marker-alt text-2xl text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Location</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">{{ $settings['location'] ?? 'Chaltatalya, Khejuri' }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-500">Purba Medinipur, 721431</p>
                    <p class="text-sm text-gray-500 dark:text-gray-500">West Bengal, India</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Projects Section -->
<section id="projects" class="py-20">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl font-bold text-gray-800 dark:text-white mb-4">Featured Projects</h2>
            <p class="text-xl text-gray-600 dark:text-gray-400">Some of my recent work and achievements</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @foreach($projects as $project)
            <div class="bento-box p-6 group hover:scale-105 transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                @if($project->image)
                <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 rounded-lg mb-4 overflow-hidden">
                    <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                </div>
                @endif
                
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">{{ $project->title }}</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4">{{ Str::limit($project->description, 100) }}</p>
                
                <!-- Tech Stack -->
                <div class="flex flex-wrap gap-2 mb-4">
                    @foreach($project->tech_stack_array as $tech)
                    <span class="px-3 py-1 bg-primary-100 dark:bg-primary-900 text-primary-600 dark:text-primary-400 rounded-full text-sm">
                        {{ trim($tech) }}
                    </span>
                    @endforeach
                </div>
                
                <!-- Links -->
                <div class="flex gap-4">
                    @if($project->github_link)
                    <a href="{{ $project->github_link }}" target="_blank" class="text-gray-600 dark:text-gray-400 hover:text-primary-600 transition-colors">
                        <i class="fab fa-github text-xl"></i>
                    </a>
                    @endif
                    @if($project->live_link)
                    <a href="{{ $project->live_link }}" target="_blank" class="text-gray-600 dark:text-gray-400 hover:text-primary-600 transition-colors">
                        <i class="fas fa-external-link-alt text-xl"></i>
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- View All Projects Button -->
        <div class="text-center" data-aos="fade-up">
            <button onclick="showAllProjects()" class="px-8 py-4 bg-primary-600 text-white rounded-full hover:bg-primary-700 transition-all duration-300 transform hover:scale-105">
                View All Projects
            </button>
        </div>
    </div>
</section>

<!-- In the Lab Section -->
<section id="upcoming" class="py-20 bg-white/50 dark:bg-gray-800/50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl font-bold text-gray-800 dark:text-white mb-4">🧪 In the Lab</h2>
            <p class="text-xl text-gray-600 dark:text-gray-400">Projects currently in development</p>
        </div>
        
        <div class="grid md:grid-cols-2 gap-8">
            @foreach($upcomingProjects as $project)
            <div class="bento-box p-8" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white">{{ $project->title }}</h3>
                    <span class="px-3 py-1 rounded-full text-sm {{ $project->status_badge }}">
                        {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                    </span>
                </div>
                
                <p class="text-gray-600 dark:text-gray-400 mb-4">{{ $project->description }}</p>
                
                <!-- Progress Bar -->
                <div class="mb-4">
                    <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400 mb-2">
                        <span>Progress</span>
                        <span>{{ $project->progress_percentage }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                        <div class="bg-{{ $project->progress_color }}-500 h-2 rounded-full transition-all duration-300" 
                             style="width: {{ $project->progress_percentage }}%"></div>
                    </div>
                </div>
                
                <!-- Expected Completion -->
                <div class="flex items-center text-sm text-gray-600 dark:text-gray-400 mb-4">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    Expected: {{ $project->expected_completion->format('M Y') }}
                </div>
                
                <!-- Tech Stack -->
                <div class="flex flex-wrap gap-2">
                    @foreach($project->tech_stack_array as $tech)
                    <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 rounded text-sm">
                        {{ trim($tech) }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Skills Section -->
<section id="skills" class="py-20">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl font-bold text-gray-800 dark:text-white mb-4">Skills & Technologies</h2>
            <p class="text-xl text-gray-600 dark:text-gray-400">Technologies I work with</p>
        </div>
        
        @foreach($skillsByCategory as $category => $categorySkills)
        <div class="mb-12" data-aos="fade-up">
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 capitalize">{{ str_replace('_', ' ', $category) }}</h3>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($categorySkills as $skill)
                <div class="bento-box p-6 text-center group hover:scale-105 transition-all duration-300">
                    @if($skill->icon)
                    <div class="text-4xl mb-4">{{ $skill->icon }}</div>
                    @endif
                    <h4 class="font-bold text-gray-800 dark:text-white mb-2">{{ $skill->name }}</h4>
                    <div class="flex justify-center mb-2">
                        <div class="text-yellow-400">{{ $skill->proficiency_stars }}</div>
                    </div>
                    @if($skill->description)
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $skill->description }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- QA Toolkit Section -->
<section id="qa-toolkit" class="py-20 bg-white/50 dark:bg-gray-800/50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl font-bold text-gray-800 dark:text-white mb-4">🔍 QA Toolkit</h2>
            <p class="text-xl text-gray-600 dark:text-gray-400">Quality Assurance achievements and expertise</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($qaAchievements as $achievement)
            <div class="bento-box p-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="flex items-center mb-4">
                    <div class="text-2xl mr-3">{{ $achievement->tool_icon }}</div>
                    <div>
                        <h3 class="font-bold text-gray-800 dark:text-white">{{ $achievement->title }}</h3>
                        <span class="px-2 py-1 rounded text-sm {{ $achievement->achievement_type_color }}">
                            {{ ucfirst(str_replace('_', ' ', $achievement->achievement_type)) }}
                        </span>
                    </div>
                </div>
                
                <p class="text-gray-600 dark:text-gray-400 mb-4">{{ $achievement->description }}</p>
                
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Tool Used:</span>
                        <span class="font-semibold text-gray-800 dark:text-white">{{ $achievement->tool_used }}</span>
                    </div>
                    @if($achievement->bugs_found > 0)
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Bugs Found:</span>
                        <span class="font-semibold text-red-600">{{ $achievement->bugs_found }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Date:</span>
                        <span class="font-semibold text-gray-800 dark:text-white">{{ $achievement->achievement_date->format('M Y') }}</span>
                    </div>
                </div>
                
                @if($achievement->impact)
                <div class="mt-4 p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                    <p class="text-sm text-green-700 dark:text-green-400">
                        <i class="fas fa-chart-line mr-2"></i>{{ $achievement->impact }}
                    </p>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-20">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl font-bold text-gray-800 dark:text-white mb-4">Get In Touch</h2>
            <p class="text-xl text-gray-600 dark:text-gray-400">Let's discuss your next project</p>
        </div>
        
        <div class="grid lg:grid-cols-2 gap-12">
            <!-- Contact Info -->
            <div class="space-y-8" data-aos="fade-right">
                <div class="bento-box p-8">
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Contact Information</h3>
                    
                    <div class="space-y-6">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-primary-100 dark:bg-primary-900 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-envelope text-primary-600"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800 dark:text-white">Email</p>
                                <p class="text-gray-600 dark:text-gray-400">{{ $settings['email'] ?? 'sandipanbhunia18@gmail.com' }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-phone text-green-600"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800 dark:text-white">Phone</p>
                                <p class="text-gray-600 dark:text-gray-400">{{ $settings['phone'] ?? '+91 8972966158' }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-map-marker-alt text-purple-600"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800 dark:text-white">Location</p>
                                <p class="text-gray-600 dark:text-gray-400">{{ $settings['location'] ?? 'Purba Medinipur, West Bengal' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div data-aos="fade-left">
                <div class="bento-box p-8">
                    <form onsubmit="handleContact(event)" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Name</label>
                            <input type="text" name="name" required 
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                            <input type="email" name="email" required 
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Subject</label>
                            <input type="text" name="subject" required 
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Message</label>
                            <textarea name="message" rows="5" required 
                                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></textarea>
                        </div>
                        
                        <button type="submit" 
                                class="w-full px-8 py-4 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-all duration-300 transform hover:scale-105 font-semibold">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
function showAllProjects() {
    const allProjects = @json($allProjects);
    
    let projectsHtml = '';
    allProjects.forEach((project, index) => {
        const techStack = project.tech_stack.split(',').map(tech => 
            `<span class="px-3 py-1 bg-primary-100 dark:bg-primary-900 text-primary-600 dark:text-primary-400 rounded-full text-sm">${tech.trim()}</span>`
        ).join('');
        
        const githubLink = project.github_link ? 
            `<a href="${project.github_link}" target="_blank" class="text-gray-600 dark:text-gray-400 hover:text-primary-600 transition-colors">
                <i class="fab fa-github text-xl"></i>
            </a>` : '';
            
        const liveLink = project.live_link ? 
            `<a href="${project.live_link}" target="_blank" class="text-gray-600 dark:text-gray-400 hover:text-primary-600 transition-colors">
                <i class="fas fa-external-link-alt text-xl"></i>
            </a>` : '';
        
        projectsHtml += `
            <div class="bento-box p-6 group hover:scale-105 transition-all duration-300">
                ${project.image ? `<div class="w-full h-48 bg-gray-200 dark:bg-gray-700 rounded-lg mb-4 overflow-hidden">
                    <img src="${project.image_url}" alt="${project.title}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                </div>` : ''}
                
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">${project.title}</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4">${project.description}</p>
                
                <div class="flex flex-wrap gap-2 mb-4">
                    ${techStack}
                </div>
                
                <div class="flex gap-4">
                    ${githubLink}
                    ${liveLink}
                </div>
            </div>
        `;
    });
    
    Swal.fire({
        title: 'All Projects',
        html: `<div class="grid md:grid-cols-2 gap-6 max-h-96 overflow-y-auto">${projectsHtml}</div>`,
        width: '90%',
        showCloseButton: true,
        showConfirmButton: false,
        customClass: {
            popup: 'dark:bg-gray-800',
            title: 'dark:text-white',
            htmlContainer: 'dark:text-gray-300'
        }
    });
}
</script>
@endpush
@endsection