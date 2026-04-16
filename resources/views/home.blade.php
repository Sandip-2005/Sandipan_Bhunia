@extends('layout')

@section('content')
    <!-- Hero Section -->
    <section id="home" class="min-vh-100 d-flex align-items-center">
        <!-- Floating Elements for Visual Appeal -->
        <div class="floating-elements">
            <div class="floating-element" style="top: 10%; left: 10%; animation-delay: 0s;">
                <i class="fas fa-code" style="color: var(--primary-color); font-size: 2rem; opacity: 0.3;"></i>
            </div>
            <div class="floating-element" style="top: 20%; right: 15%; animation-delay: 2s;">
                <i class="fas fa-laptop-code" style="color: var(--secondary-color); font-size: 1.5rem; opacity: 0.3;"></i>
            </div>
            <div class="floating-element" style="bottom: 30%; left: 5%; animation-delay: 4s;">
                <i class="fas fa-database" style="color: var(--accent-color); font-size: 1.8rem; opacity: 0.3;"></i>
            </div>
            <div class="floating-element" style="bottom: 15%; right: 10%; animation-delay: 1s;">
                <i class="fas fa-bug" style="color: var(--warning-color); font-size: 1.6rem; opacity: 0.3;"></i>
            </div>
        </div>

        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="animate-fadeInUp">

                        <!-- Unique Name Hero Block -->
                        <div class="hero-name-block mb-4">
                            <div class="hero-greeting">
                                <span class="hero-greeting-line"></span>
                                <span class="hero-greeting-text">Hello, World! 👋</span>
                            </div>
                            <h1 class="hero-identity">
                                <span class="hero-im">I'm</span>
                                <span class="hero-firstname">Sandipan</span>
                                <span class="hero-lastname-wrapper">
                                    <span class="hero-lastname">Bhunia</span>
                                    <span class="hero-lastname-glow">Bhunia</span>
                                </span>
                            </h1>
                        </div>

                        <h2 class="h3 text-white-50 mb-4 hero-subtitle">
                                {{ $settings['hero_subtitle'] ?? 'Full Stack Developer & QA Engineer' }}
                            </h2>
                            <p class="lead text-white-50 mb-5">
                                {{ $settings['hero_description'] ?? 'Passionate about building dynamic web applications, real-time billing systems, and secure dashboards.' }}
                            </p>

                            <div class="d-flex flex-column flex-sm-row gap-3 flex-wrap">
                                <a href="#projects" class="btn-handmade">
                                    <i class="fas fa-eye me-2"></i>View My Work
                                </a>
                                <a href="#contact" class="btn btn-outline-light rounded-pill px-4 py-2">
                                    <i class="fas fa-envelope me-2"></i>Get In Touch
                                </a>
                                @if(isset($publicCvs) && $publicCvs->count() > 0)
                                    @foreach($publicCvs as $cv)
                                        <div class="d-flex gap-2">
                                            <a href="{{ $cv->download_url }}" class="btn-cv-download" target="_blank"
                                                title="Download {{ $cv->label }}">
                                                <i class="fas fa-download me-2"></i>{{ $cv->label }}
                                            </a>
                                            <button
                                                onclick="viewCV('{{ $cv->id }}', '{{ addslashes($cv->label) }}', '{{ route('cv.view', $cv->id) }}', '{{ $cv->download_url }}')"
                                                class="btn-cv-view" title="View {{ $cv->label }}">
                                                <i class="fas fa-eye me-2"></i>View
                                            </button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 text-center">
                        <div class="animate-float">
                            <div class="position-relative d-inline-block">
                                @if(isset($settings['profile_photo']) && $settings['profile_photo'])
                                    <!-- Profile Photo -->
                                    <div class="position-relative">
                                        <img src="{{ asset('uploads/profile/' . $settings['profile_photo']) }}"
                                            alt="Sandipan Bhunia"
                                            class="rounded-circle border border-primary shadow-lg profile-image"
                                            style="width: 320px; height: 320px; object-fit: cover; border-width: 4px !important;">
                                        <div
                                            class="position-absolute bottom-0 end-0 bg-primary rounded-circle p-3 shadow profile-badge">
                                            <i class="fas fa-code text-white fa-2x"></i>
                                        </div>
                                    </div>
                                @else
                                    <!-- Default Professional Avatar -->
                                    <div class="position-relative">
                                        <img src="{{ asset('images/default-avatar.svg') }}"
                                            alt="Sandipan Bhunia - Full Stack Developer"
                                            class="rounded-circle border border-primary shadow-lg profile-image"
                                            style="width: 320px; height: 320px; object-fit: cover; border-width: 4px !important;">
                                        <div
                                            class="position-absolute bottom-0 end-0 bg-primary rounded-circle p-3 shadow profile-badge">
                                            <i class="fas fa-code text-white fa-2x"></i>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="py-5 section-animate">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="display-5 fw-bold text-white mb-4 section-title">About Me</h2>
                    <p class="lead text-white-50">A passionate full-stack developer with expertise in modern web technologies
                    </p>
                </div>

                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="handmade-card p-4 h-100 text-center section-animate">
                            <div class="mb-3">
                                <i class="fas fa-graduation-cap fa-2x animate-bounce-in"
                                    style="color: var(--primary-color);"></i>
                            </div>
                            <h5 class="fw-bold text-white mb-3">Education</h5>
                            <p class="text-white-50 mb-3">Bachelor of Computer Application</p>
                            <small class="text-muted">Contai College (MAKAUT) | 2023 - 2026</small>
                            <div class="mt-3">
                                <span class="badge bg-primary">SGPA: 8.86, 8.18, 7.43, 7.83</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="handmade-card p-4 h-100 text-center section-animate">
                            <div class="mb-3">
                                <i class="fas fa-code fa-2x text-success animate-bounce-in"></i>
                            </div>
                            <h5 class="fw-bold text-white mb-3">Experience</h5>
                            <p class="text-white-50 mb-3">Full Stack Development</p>
                            <small class="text-muted">PHP, Laravel, MySQL, Modern Web Technologies</small>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="handmade-card p-4 h-100 text-center section-animate">
                            <div class="mb-3">
                                <i class="fas fa-map-marker-alt fa-2x text-warning animate-bounce-in"></i>
                            </div>
                            <h5 class="fw-bold text-white mb-3">Location</h5>
                            <p class="text-white-50 mb-3">{{ $settings['location'] ?? 'Chaltatalya, Khejuri' }}</p>
                            <small class="text-muted">Purba Medinipur, West Bengal, India</small>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Projects Section -->
        @if($projects->count() > 0)
            <section id="projects" class="py-5 section-animate">
                <div class="container">
                    <div class="text-center mb-5">
                        <h2 class="display-5 fw-bold text-white mb-4 section-title">Featured Projects</h2>
                        <p class="lead text-white-50">Some of my recent work and achievements</p>
                    </div>

                    <div class="row g-4">
                        @foreach($projects as $project)
                            <div class="col-lg-6">
                                <div class="handmade-card p-4 h-100 section-animate">
                                    @if($project->image)
                                        <div class="mb-4">
                                            <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="img-fluid rounded"
                                                style="height: 200px; width: 100%; object-fit: cover;">
                                        </div>
                                    @endif

                                    <h5 class="fw-bold text-white mb-3">{{ $project->title }}</h5>
                                    <p class="text-white-50 mb-4">{{ Str::limit($project->description, 120) }}</p>

                                    <div class="mb-4">
                                        @foreach($project->tech_stack_array as $tech)
                                            <span class="badge me-2 mb-2" style="background: var(--primary-color);">{{ trim($tech) }}</span>
                                        @endforeach
                                    </div>

                                    <div class="d-flex gap-3">
                                        @if($project->github_link)
                                            <a href="{{ $project->github_link }}" target="_blank" class="text-white-50 hover-primary">
                                                <i class="fab fa-github fa-lg"></i>
                                            </a>
                                        @endif
                                        @if($project->live_link)
                                            <a href="{{ $project->live_link }}" target="_blank" class="text-white-50 hover-primary">
                                                <i class="fas fa-external-link-alt fa-lg"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($allProjects->count() > $projects->count())
                        <div class="text-center mt-5">
                            <button onclick="showAllProjects()" class="btn-handmade">
                                <i class="fas fa-eye me-2"></i>View All Projects
                            </button>
                        </div>
                    @endif
                </div>
            </section>
        @endif

        <!-- In the Lab Section -->
        @if($upcomingProjects->count() > 0)
            <section id="upcoming" class="py-5">
                <div class="container">
                    <div class="text-center mb-5">
                        <h2 class="display-5 fw-bold text-white mb-4">🧪 In the Lab</h2>
                        <p class="lead text-white-50">Projects currently in development</p>
                    </div>

                    <div class="row g-4">
                        @foreach($upcomingProjects as $project)
                            <div class="col-md-6">
                                <div class="handmade-card p-4 h-100">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <h5 class="fw-bold text-white">{{ $project->title }}</h5>
                                        <span
                                            class="badge {{ $project->status == 'in_progress' ? 'bg-warning' : ($project->status == 'planning' ? 'bg-info' : 'bg-secondary') }}">
                                            {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                        </span>
                                    </div>

                                    <p class="text-white-50 mb-4">{{ $project->description }}</p>

                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between mb-2">
                                            <small class="text-white-50">Progress</small>
                                            <small class="text-white-50">{{ $project->progress_percentage }}%</small>
                                        </div>
                                        <div class="skill-progress">
                                            <div class="skill-progress-bar" data-width="{{ $project->progress_percentage }}"></div>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center text-white-50 mb-3">
                                        <i class="fas fa-calendar-alt me-2"></i>
                                        <small>Expected: {{ $project->expected_completion->format('M Y') }}</small>
                                    </div>

                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($project->tech_stack_array as $tech)
                                            <span class="badge bg-secondary">{{ trim($tech) }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- Skills Section - ENHANCED ATTRACTIVE DESIGN -->
        @if($skills->count() > 0)
            <section id="skills" class="py-5">
                <div class="container">
                    <div class="text-center mb-5">
                        <h2 class="display-5 fw-bold text-white mb-4">💻 Skills & Technologies</h2>
                        <p class="lead text-white-50">Technologies I work with and my expertise levels</p>
                    </div>

                    @foreach($skillsByCategory as $category => $categorySkills)
                        <div class="mb-4"> <!-- Reduced from mb-5 -->
                            <div class="category-header mb-3"> <!-- Reduced from mb-4 -->
                                <h3 class="category-title">
                                    @if($category == 'backend')
                                        <i class="fas fa-server category-icon"></i>
                                        <span>Backend Development</span>
                                    @elseif($category == 'frontend')
                                        <i class="fas fa-palette category-icon"></i>
                                        <span>Frontend Development</span>
                                    @elseif($category == 'database')
                                        <i class="fas fa-database category-icon"></i>
                                        <span>Database Technologies</span>
                                    @elseif($category == 'tools')
                                        <i class="fas fa-tools category-icon"></i>
                                        <span>Development Tools</span>
                                    @elseif($category == 'framework')
                                        <i class="fas fa-layer-group category-icon"></i>
                                        <span>Frameworks & Libraries</span>
                                    @else
                                        <i class="fas fa-code category-icon"></i>
                                        <span>{{ ucfirst(str_replace('_', ' ', $category)) }}</span>
                                    @endif
                                </h3>
                                <div class="category-line"></div>
                            </div>

                            <div class="row g-3"> <!-- Reduced gap from g-4 -->
                                @foreach($categorySkills as $skill)
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="skill-card" data-skill="{{ strtolower($skill->name) }}">
                                            <div class="skill-card-inner">
                                                <!-- Front of card -->
                                                <div class="skill-card-front">
                                                    <div class="skill-icon-wrapper">
                                                        @if($skill->icon)
                                                            <div class="skill-icon">{{ $skill->icon }}</div>
                                                        @else
                                                            <div class="skill-icon skill-icon-default">
                                                                @if(stripos($skill->name, 'php') !== false)
                                                                    🐘
                                                                @elseif(stripos($skill->name, 'javascript') !== false)
                                                                    ⚡
                                                                @elseif(stripos($skill->name, 'html') !== false)
                                                                    🌐
                                                                @elseif(stripos($skill->name, 'css') !== false)
                                                                    🎨
                                                                @elseif(stripos($skill->name, 'mysql') !== false)
                                                                    🗄️
                                                                @elseif(stripos($skill->name, 'laravel') !== false)
                                                                    🔥
                                                                @elseif(stripos($skill->name, 'bootstrap') !== false)
                                                                    🅱️
                                                                @elseif(stripos($skill->name, 'git') !== false)
                                                                    📚
                                                                @else
                                                                    💻
                                                                @endif
                                                            </div>
                                                        @endif
                                                        <div class="skill-glow"></div>
                                                    </div>

                                                    <h4 class="skill-name">{{ $skill->name }}</h4>

                                                    <div class="skill-level">
                                                        <div class="skill-stars">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <i class="fas fa-star {{ $i <= $skill->proficiency_level ? 'active' : '' }}"
                                                                    style="animation-delay: {{ $i * 0.1 }}s"></i>
                                                            @endfor
                                                        </div>
                                                    </div>

                                                    <div class="skill-progress-wrapper">
                                                        <div class="skill-progress-track">
                                                            <div class="skill-progress-fill"
                                                                data-width="{{ $skill->proficiency_level * 20 }}"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Back of card -->
                                                <div class="skill-card-back">
                                                    <div class="skill-details">
                                                        <h4 class="skill-name-back">{{ $skill->name }}</h4>
                                                        @if($skill->description)
                                                            <p class="skill-description">{{ $skill->description }}</p>
                                                        @else
                                                            <p class="skill-description">
                                                                @if(stripos($skill->name, 'php') !== false)
                                                                    Server-side scripting language for web development
                                                                @elseif(stripos($skill->name, 'javascript') !== false)
                                                                    Dynamic programming language for interactive web experiences
                                                                @elseif(stripos($skill->name, 'html') !== false)
                                                                    Markup language for structuring web content
                                                                @elseif(stripos($skill->name, 'css') !== false)
                                                                    Styling language for beautiful web interfaces
                                                                @elseif(stripos($skill->name, 'mysql') !== false)
                                                                    Relational database management system
                                                                @elseif(stripos($skill->name, 'laravel') !== false)
                                                                    PHP framework for elegant web applications
                                                                @else
                                                                    Professional expertise in {{ $skill->name }}
                                                                @endif
                                                            </p>
                                                        @endif

                                                        <div class="skill-experience">
                                                            <div class="experience-item">
                                                                <i class="fas fa-clock"></i>
                                                                <span>
                                                                    @if($skill->experience_text)
                                                                        {{ $skill->experience_text }}
                                                                    @elseif($skill->proficiency_level >= 4)
                                                                        3+ Years Experience
                                                                    @elseif($skill->proficiency_level >= 3)
                                                                        2+ Years Experience
                                                                    @else
                                                                        1+ Year Experience
                                                                    @endif
                                                                </span>
                                                            </div>
                                                            <div class="experience-item">
                                                                <i class="fas fa-project-diagram"></i>
                                                                <span>
                                                                    @if($skill->projects_text)
                                                                        {{ $skill->projects_text }}
                                                                    @elseif($skill->proficiency_level >= 4)
                                                                        10+ Projects
                                                                    @elseif($skill->proficiency_level >= 3)
                                                                        5+ Projects
                                                                    @else
                                                                        Multiple Projects
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Achievements Section -->
        @if($qaAchievements->count() > 0)
            <section id="achievements" class="py-5">
                <div class="container">
                    <div class="text-center mb-5">
                        <h2 class="display-5 fw-bold text-white mb-4">🏆 Achievements</h2>
                        <p class="lead text-white-50">My accomplishments, certifications, and milestones</p>
                    </div>

                    <div class="row g-4">
                        @foreach($qaAchievements as $achievement)
                            <div class="col-lg-4">
                                <div class="handmade-card p-4 h-100">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="me-3" style="font-size: 1.5rem;">{{ $achievement->tool_icon }}</div>
                                        <div>
                                            <h6 class="fw-bold text-white mb-1">{{ $achievement->title }}</h6>
                                            <span
                                                class="badge {{ $achievement->achievement_type == 'bug_found' ? 'bg-danger' : ($achievement->achievement_type == 'automation_created' ? 'bg-info' : 'bg-success') }}">
                                                {{ ucfirst(str_replace('_', ' ', $achievement->achievement_type)) }}
                                            </span>
                                        </div>
                                    </div>

                                    <p class="text-white-50 mb-4">{{ $achievement->description }}</p>

                                    <div class="row text-center mb-3">
                                        <div class="col-6">
                                            <small class="text-white-50 d-block">Tool Used</small>
                                            <strong class="text-white">{{ $achievement->tool_used }}</strong>
                                        </div>
                                        @if($achievement->bugs_found > 0)
                                            <div class="col-6">
                                                <small class="text-white-50 d-block">Bugs Found</small>
                                                <strong class="text-danger">{{ $achievement->bugs_found }}</strong>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="text-center">
                                        <small class="text-white-50">{{ $achievement->achievement_date->format('M Y') }}</small>
                                    </div>

                                    @if($achievement->impact)
                                        <div class="mt-3 p-3 rounded" style="background: rgba(34, 197, 94, 0.1);">
                                            <small class="text-success">
                                                <i class="fas fa-chart-line me-2"></i>{{ $achievement->impact }}
                                            </small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- Contact Section -->
        <section id="contact" class="py-5">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="display-5 fw-bold text-white mb-4">Get In Touch</h2>
                    <p class="lead text-white-50">Let's discuss your next project</p>
                </div>

                <div class="row g-5">
                    <div class="col-lg-6">
                        <div class="handmade-card p-4">
                            <h5 class="fw-bold text-white mb-4">Contact Information</h5>

                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3">
                                    <i class="fas fa-envelope fa-lg" style="color: var(--primary-color);"></i>
                                </div>
                                <div>
                                    <h6 class="text-white mb-1">Email</h6>
                                    <a href="mailto:{{ $settings['email'] ?? 'sandipanbhunia18@gmail.com' }}"
                                        class="text-white-50 text-decoration-none"
                                        onclick="return confirmNavigation(event, 'Open your email app?')">
                                        <p class="text-white-50 mb-0">{{ $settings['email'] ?? 'sandipanbhunia18@gmail.com' }}
                                        </p>
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3">
                                    <i class="fas fa-phone fa-lg text-success"></i>
                                </div>
                                <div>
                                    <h6 class="text-white mb-1">Phone</h6>
                                    <a href="tel:{{ $settings['phone'] ?? '+918972966158' }}"
                                        class="text-white-50 text-decoration-none"
                                        onclick="return confirmNavigation(event, 'Open dialer to call?')">
                                        <p class="text-white-50 mb-0">{{ $settings['phone'] ?? '+91 8972966158' }}</p>
                                    </a>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-map-marker-alt fa-lg text-warning"></i>
                                </div>
                                <div>
                                    <h6 class="text-white mb-1">Location</h6>
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($settings['location'] ?? 'Purba Medinipur, West Bengal, India') }}"
                                        target="_blank" rel="noopener noreferrer" class="text-white-50 text-decoration-none"
                                        onclick="return confirmNavigation(event, 'Open location in maps?')">
                                        <p class="text-white-50 mb-0">
                                            {{ $settings['location'] ?? 'Purba Medinipur, West Bengal' }}</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="handmade-card p-4">
                            <form onsubmit="handleContact(event)">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label text-white">Name</label>
                                    <input type="text" name="name"
                                        class="form-control bg-transparent border-secondary text-white" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-white">Email</label>
                                    <input type="email" name="email"
                                        class="form-control bg-transparent border-secondary text-white" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-white">Subject</label>
                                    <input type="text" name="subject"
                                        class="form-control bg-transparent border-secondary text-white" required>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label text-white">Message</label>
                                    <textarea name="message" rows="5"
                                        class="form-control bg-transparent border-secondary text-white" required></textarea>
                                </div>

                                <button type="submit" class="btn-handmade w-100">
                                    <i class="fas fa-paper-plane me-2"></i>Send Message
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

                    if (allProjects.length === 0) {
                        alert('No projects available to display.');
                        return;
                    }

                    let projectsHtml = '<div class="row g-4">';
                    allProjects.forEach((project, index) => {
                        const techStack = project.tech_stack.split(',').map(tech =>
                            `<span class="badge me-2 mb-2" style="background: var(--primary-color);">${tech.trim()}</span>`
                        ).join('');

                        const githubLink = project.github_link ?
                            `<a href="${project.github_link}" target="_blank" class="text-white-50 me-3">
                            <i class="fab fa-github fa-lg"></i>
                        </a>` : '';

                        const liveLink = project.live_link ?
                            `<a href="${project.live_link}" target="_blank" class="text-white-50">
                            <i class="fas fa-external-link-alt fa-lg"></i>
                        </a>` : '';

                        projectsHtml += `
                        <div class="col-md-6">
                            <div class="handmade-card p-4 h-100">
                                ${project.image ? `<div class="mb-4">
                                    <img src="${project.image_url}" alt="${project.title}" 
                                         class="img-fluid rounded" style="height: 200px; width: 100%; object-fit: cover;">
                                </div>` : ''}

                                <h5 class="fw-bold text-white mb-3">${project.title}</h5>
                                <p class="text-white-50 mb-4">${project.description}</p>

                                <div class="mb-4">${techStack}</div>

                                <div class="d-flex gap-3">
                                    ${githubLink}
                                    ${liveLink}
                                </div>
                            </div>
                        </div>
                    `;
                    });
                    projectsHtml += '</div>';

                    // Simple modal alternative
                    const modal = document.createElement('div');
                    modal.className = 'position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center';
                    modal.style.background = 'rgba(0, 0, 0, 0.8)';
                    modal.style.zIndex = '9999';
                    modal.innerHTML = `
                    <div class="bg-dark rounded p-4 m-3" style="max-width: 90vw; max-height: 90vh; overflow-y: auto;">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="text-white mb-0">All Projects</h4>
                            <button class="btn btn-outline-light btn-sm" onclick="this.closest('.position-fixed').remove()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        ${projectsHtml}
                    </div>
                `;

                    document.body.appendChild(modal);
                }
            </script>
        @endpush
@endsection