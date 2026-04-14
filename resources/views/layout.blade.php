<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', $settings['site_title'] ?? 'Sandipan Bhunia - Full Stack Developer')</title>
    <meta name="description" content="@yield('description', $settings['site_description'] ?? 'Passionate full-stack developer skilled in PHP, Laravel, MySQL, and modern web technologies.')">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Simple Tailwind for utilities -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom Styles -->
    <style>
        :root {
            --primary-color: #3b82f6;
            --secondary-color: #8b5cf6;
            --dark-bg: #1a1a2e;
            --card-bg: rgba(255, 255, 255, 0.1);
            --text-light: #f8f9fa;
            --shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            overflow-x: hidden;
            transition: all 0.3s ease;
        }

        body.dark-mode {
            background: linear-gradient(135deg, #0c0c0c 0%, #1a1a2e 100%);
            color: var(--text-light);
        }

        /* Light mode text colors */
        body:not(.dark-mode) .text-white {
            color: #ffffff !important;
        }

        body:not(.dark-mode) .text-white-50 {
            color: rgba(255, 255, 255, 0.7) !important;
        }

        /* Dark mode improvements */
        .dark-mode .text-muted {
            color: #9ca3af !important;
        }

        .dark-mode .bg-transparent {
            background-color: rgba(255, 255, 255, 0.1) !important;
        }

        .dark-mode .border-secondary {
            border-color: rgba(255, 255, 255, 0.3) !important;
        }

        .dark-mode .form-control {
            color: #ffffff !important;
        }

        .dark-mode .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5) !important;
        }

        /* Light mode text improvements */
        body:not(.dark-mode) .text-white {
            color: #ffffff !important;
        }

        body:not(.dark-mode) .text-white-50 {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        body:not(.dark-mode) .text-muted {
            color: rgba(255, 255, 255, 0.7) !important;
        }

        /* Handmade Card Style */
        .handmade-card {
            background: var(--card-bg);
            backdrop-filter: blur(15px);
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .handmade-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .handmade-card:hover::before {
            transform: scaleX(1);
        }

        .handmade-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        /* Navigation */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.1) !important;
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .navbar-scrolled {
            background: rgba(255, 255, 255, 0.95) !important;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        .dark-mode .navbar-scrolled {
            background: rgba(26, 26, 46, 0.95) !important;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out;
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-pulse-custom {
            animation: pulse 2s ease-in-out infinite;
        }

        /* Skills Progress */
        .skill-progress {
            height: 8px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            overflow: hidden;
        }

        .skill-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 10px;
            transition: width 1s ease-in-out;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .handmade-card {
                margin-bottom: 20px;
            }
            
            .hero-title {
                font-size: 2.5rem !important;
            }
            
            .hero-subtitle {
                font-size: 1.2rem !important;
            }
        }

        /* Theme Toggle */
        .theme-toggle {
            width: 50px;
            height: 26px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 13px;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 4px;
        }

        .theme-toggle:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .theme-icon-light,
        .theme-icon-dark {
            font-size: 12px;
            transition: all 0.3s ease;
            z-index: 2;
        }

        .theme-icon-light {
            color: #fbbf24;
        }

        .theme-icon-dark {
            color: #6b7280;
        }

        .theme-toggle::before {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background: white;
            border-radius: 50%;
            top: 3px;
            left: 3px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .dark-mode .theme-toggle::before {
            transform: translateX(24px);
            background: #374151;
        }

        .dark-mode .theme-icon-light {
            color: #6b7280;
        }

        .dark-mode .theme-icon-dark {
            color: #fbbf24;
        }

        /* Button Styles */
        .btn-handmade {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            color: white;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-handmade::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-handmade:hover::before {
            left: 100%;
        }

        .btn-handmade:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.4);
            color: white;
        }

        /* Footer hover effects */
        .hover-primary {
            transition: color 0.3s ease;
        }

        .hover-primary:hover {
            color: var(--primary-color) !important;
        }

        /* Contact info styling */
        .contact-info .fas {
            width: 16px;
            text-align: center;
        }

        /* Footer styling for both themes */
        footer {
            background: #1a1a2e !important;
            color: #ffffff !important;
        }

        footer h5, footer h6 {
            color: #ffffff !important;
        }

        footer .text-muted {
            color: #9ca3af !important;
        }

        footer .text-white {
            color: #ffffff !important;
        }

        footer .border-secondary {
            border-color: rgba(255, 255, 255, 0.2) !important;
        }

        /* Dark mode footer adjustments */
        .dark-mode footer {
            background: #0f0f0f !important;
        }

        .dark-mode footer .text-muted {
            color: #d1d5db !important;
        }

        .dark-mode footer h5, 
        .dark-mode footer h6 {
            color: #ffffff !important;
        }

        /* Light mode footer adjustments */
        body:not(.dark-mode) footer {
            background: #1f2937 !important;
        }

        body:not(.dark-mode) footer .text-muted {
            color: #d1d5db !important;
        }

        body:not(.dark-mode) footer h5, 
        body:not(.dark-mode) footer h6 {
            color: #ffffff !important;
        }

        /* Ensure footer links are visible */
        footer a.text-muted {
            color: #9ca3af !important;
        }

        footer a.text-muted:hover {
            color: var(--primary-color) !important;
        }

        .dark-mode footer a.text-muted {
            color: #d1d5db !important;
        }

        body:not(.dark-mode) footer a.text-muted {
            color: #d1d5db !important;
        }

        /* Footer text and link classes - IMPORTANT: These override everything */
        .footer-text {
            color: #e5e7eb !important;
        }

        .footer-link {
            color: #d1d5db !important;
            transition: color 0.3s ease;
        }

        .footer-link:hover {
            color: var(--primary-color) !important;
        }

        .footer-divider {
            border-color: rgba(255, 255, 255, 0.2) !important;
        }

        /* Dark mode footer text - FORCE VISIBILITY */
        .dark-mode .footer-text {
            color: #f3f4f6 !important;
        }

        .dark-mode .footer-link {
            color: #e5e7eb !important;
        }

        /* Light mode footer text - FORCE VISIBILITY */
        body:not(.dark-mode) .footer-text {
            color: #f3f4f6 !important;
        }

        body:not(.dark-mode) .footer-link {
            color: #e5e7eb !important;
        }

        /* Additional footer text visibility fixes */
        footer * {
            color: inherit !important;
        }

        footer h5, footer h6, footer .fw-bold {
            color: #ffffff !important;
        }

        footer .footer-text, footer .footer-link {
            color: #e5e7eb !important;
        }

        footer small.footer-text {
            color: #d1d5db !important;
        }

        /* Ultimate footer text visibility fix */
        footer, footer * {
            visibility: visible !important;
            opacity: 1 !important;
        }

        footer .footer-text, 
        footer .footer-link,
        footer p,
        footer span,
        footer small,
        footer li {
            color: #e5e7eb !important;
        }

        footer h5,
        footer h6 {
            color: #ffffff !important;
        }
    </style>
</head>
<body>
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand fw-bold text-white" href="#home">
                <span style="color: var(--primary-color);">S</span>andipan
            </a>
            
            <div class="d-flex align-items-center order-lg-3">
                <!-- Theme Toggle -->
                <div class="theme-toggle me-3" onclick="toggleTheme()" title="Toggle Dark/Light Mode">
                    <i class="fas fa-sun theme-icon-light"></i>
                    <i class="fas fa-moon theme-icon-dark"></i>
                </div>
                
                <!-- Mobile Menu Button -->
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <i class="fas fa-bars text-white"></i>
                </button>
            </div>
            
            <div class="collapse navbar-collapse order-lg-2" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#projects">Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#skills">Skills</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#qa-toolkit">QA Toolkit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="py-5 mt-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3">
                            <span style="color: var(--primary-color);">S</span>andipan Bhunia
                        </h5>
                        <p class="footer-text mb-4">Full Stack Developer & QA Engineer passionate about creating innovative web solutions and ensuring quality through comprehensive testing.</p>
                        
                        <!-- Social Links -->
                        <div class="d-flex gap-3 mb-3">
                            <a href="{{ $settings['github'] ?? '#' }}" class="footer-link hover-primary" target="_blank" title="GitHub">
                                <i class="fab fa-github fa-lg"></i>
                            </a>
                            <a href="{{ $settings['linkedin'] ?? '#' }}" class="footer-link hover-primary" target="_blank" title="LinkedIn">
                                <i class="fab fa-linkedin fa-lg"></i>
                            </a>
                            <a href="mailto:{{ $settings['email'] ?? 'sandipanbhunia18@gmail.com' }}" class="footer-link hover-primary" title="Email">
                                <i class="fas fa-envelope fa-lg"></i>
                            </a>
                            <a href="tel:{{ $settings['phone'] ?? '+918972966158' }}" class="footer-link hover-primary" title="Phone">
                                <i class="fas fa-phone fa-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold mb-3">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#home" class="footer-link text-decoration-none hover-primary">Home</a></li>
                        <li class="mb-2"><a href="#about" class="footer-link text-decoration-none hover-primary">About</a></li>
                        <li class="mb-2"><a href="#projects" class="footer-link text-decoration-none hover-primary">Projects</a></li>
                        <li class="mb-2"><a href="#skills" class="footer-link text-decoration-none hover-primary">Skills</a></li>
                        <li class="mb-2"><a href="#qa-toolkit" class="footer-link text-decoration-none hover-primary">QA Toolkit</a></li>
                        <li class="mb-2"><a href="#contact" class="footer-link text-decoration-none hover-primary">Contact</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <h6 class="fw-bold mb-3">Services</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><span class="footer-text">Web Development</span></li>
                        <li class="mb-2"><span class="footer-text">Laravel Applications</span></li>
                        <li class="mb-2"><span class="footer-text">Quality Assurance</span></li>
                        <li class="mb-2"><span class="footer-text">Database Design</span></li>
                        <li class="mb-2"><span class="footer-text">API Development</span></li>
                        <li class="mb-2"><span class="footer-text">Testing & Debugging</span></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <h6 class="fw-bold mb-3">Contact Info</h6>
                    <div class="contact-info">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-envelope text-primary me-2"></i>
                            <small class="footer-text">{{ $settings['email'] ?? 'sandipanbhunia18@gmail.com' }}</small>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-phone text-primary me-2"></i>
                            <small class="footer-text">{{ $settings['phone'] ?? '+91 8972966158' }}</small>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-map-marker-alt text-primary me-2 mt-1"></i>
                            <small class="footer-text">{{ $settings['location'] ?? 'Chaltatalya, Khejuri, Purba Medinipur, 721431, West Bengal, India' }}</small>
                        </div>
                        
                        <!-- Education Badge -->
                        <div class="mt-3">
                            <span class="badge bg-primary">BCA Student (2023-2026)</span>
                            <span class="badge bg-secondary ms-1">MAKAUT</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr class="my-4 footer-divider">
            
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 footer-text">
                        &copy; {{ date('Y') }} Sandipan Bhunia. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <small class="footer-text">
                        Built with <i class="fas fa-heart text-danger"></i> using Laravel & Bootstrap
                    </small>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Simple Custom JavaScript -->
    <script>
        // Theme Toggle
        let isDarkMode = localStorage.getItem('darkMode') === 'true';
        
        function toggleTheme() {
            isDarkMode = !isDarkMode;
            localStorage.setItem('darkMode', isDarkMode);
            document.body.classList.toggle('dark-mode', isDarkMode);
            
            // Force refresh of footer styles
            const footer = document.querySelector('footer');
            if (footer) {
                footer.style.display = 'none';
                footer.offsetHeight; // Trigger reflow
                footer.style.display = '';
            }
        }
        
        // Initialize theme
        document.body.classList.toggle('dark-mode', isDarkMode);
        
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('mainNavbar');
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });
        
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Simple fade-in animation on scroll
        function animateOnScroll() {
            const elements = document.querySelectorAll('.handmade-card');
            elements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const elementVisible = 150;
                
                if (elementTop < window.innerHeight - elementVisible) {
                    element.classList.add('animate-fadeInUp');
                }
            });
        }
        
        window.addEventListener('scroll', animateOnScroll);
        
        // Contact form handler
        function handleContact(event) {
            event.preventDefault();
            
            const formData = new FormData(event.target);
            
            fetch('{{ route("contact") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Message sent successfully! Thank you for reaching out.');
                    event.target.reset();
                }
            })
            .catch(error => {
                alert('Something went wrong! Please try again.');
            });
        }
        
        // Initialize animations
        document.addEventListener('DOMContentLoaded', function() {
            animateOnScroll();
            
            // Animate skill progress bars
            setTimeout(() => {
                document.querySelectorAll('.skill-progress-bar').forEach(bar => {
                    const width = bar.getAttribute('data-width');
                    bar.style.width = width + '%';
                });
            }, 500);
        });
    </script>

    @stack('scripts')
</body>
</html>