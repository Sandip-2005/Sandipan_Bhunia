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
            /* Light Mode Colors - Modern & Attractive */
            --primary-color: #6366f1;
            --secondary-color: #ec4899;
            --accent-color: #06b6d4;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            
            /* Light Mode Backgrounds - Vibrant & Modern */
            --light-bg: linear-gradient(135deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #f5576c 75%, #4facfe 100%);
            --light-card-bg: rgba(255, 255, 255, 0.25);
            --light-navbar-bg: rgba(255, 255, 255, 0.15);
            --light-footer-bg: #1e293b;
            
            /* Dark Mode Backgrounds */
            --dark-bg: linear-gradient(135deg, #0f172a 0%, #1e293b 25%, #312e81 50%, #7c2d92 75%, #1e1b4b 100%);
            --dark-card-bg: rgba(255, 255, 255, 0.08);
            --dark-navbar-bg: rgba(0, 0, 0, 0.3);
            --dark-footer-bg: #0f172a;
            
            /* Text Colors */
            --text-light: #f8fafc;
            --text-muted-light: rgba(255, 255, 255, 0.85);
            --text-muted-dark: #94a3b8;
            
            /* Effects */
            --shadow-light: 0 10px 40px rgba(0, 0, 0, 0.15);
            --shadow-dark: 0 10px 40px rgba(0, 0, 0, 0.4);
            --blur-effect: blur(20px);
        }

        html, body {
            width: 100%;
            overflow-x: hidden;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--light-bg);
            min-height: 100vh;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            line-height: 1.6;
            padding-top: 70px;
        }

        body.dark-mode {
            background: var(--dark-bg);
            color: var(--text-light);
        }

        /* Container improvements for better spacing */
        .container {
            max-width: 1200px;
            padding-left: 2rem;
            padding-right: 2rem;
        }

        @media (max-width: 768px) {
            .container {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }

        /* Fix main content positioning */
        main {
            position: relative;
            z-index: 1;
        }

        /* Ensure sections don't overlap with navbar - PROFESSIONAL SPACING */
        section {
            scroll-margin-top: 90px;
            padding: 4rem 0; /* More generous section padding */
        }

        /* Fix hero section height calculation - BETTER SPACING */
        #home {
            min-height: calc(100vh - 75px);
            padding: 4rem 0; /* More generous padding for better spacing */
            display: flex;
            align-items: center;
            position: relative;
        }

        /* Add attractive background elements */
        #home::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 80%, rgba(99, 102, 241, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(236, 72, 153, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(6, 182, 212, 0.2) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        #home .container {
            position: relative;
            z-index: 1;
        }

        /* Mobile spacing adjustments */
        @media (max-width: 768px) {
            body {
                padding-top: 70px; /* Match fixed navbar height */
            }
            
            section {
                padding: 2.5rem 0; /* Good mobile spacing */
            }
            
            #home {
                min-height: calc(100vh - 70px);
                padding: 3rem 0; /* Better mobile spacing */
            }
            
            section {
                padding: 3rem 0; /* Better mobile section spacing */
            }
        }

        /* Enhanced Typography with Better Visibility - PROFESSIONAL & ATTRACTIVE SIZES */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 700;
            letter-spacing: -0.025em;
        }

        .display-3 {
            font-weight: 800;
            letter-spacing: -0.05em;
            font-size: 3.5rem !important; /* Larger, more impressive hero title */
            background: linear-gradient(135deg, #ffffff, #f8fafc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .display-5 {
            font-size: 2.2rem !important; /* Larger section titles */
        }

        /* ============================================
           UNIQUE HERO NAME BLOCK
        ============================================ */
        .hero-name-block {
            position: relative;
        }

        /* "Hello, World!" greeting row */
        .hero-greeting {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.6rem;
            opacity: 0;
            animation: fadeInUp 0.7s ease-out 0.2s forwards;
        }

        .hero-greeting-line {
            display: inline-block;
            width: 40px;
            height: 3px;
            background: linear-gradient(90deg, #a78bfa, #ec4899);
            border-radius: 2px;
            flex-shrink: 0;
        }

        .hero-greeting-text {
            font-size: 0.95rem;
            font-weight: 600;
            color: rgba(255,255,255,0.75);
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        /* Main identity h1 */
        .hero-identity {
            margin: 0;
            padding: 0;
            line-height: 1.05;
            opacity: 0;
            animation: fadeInUp 0.8s ease-out 0.4s forwards;
        }

        /* "I'm" */
        .hero-im {
            display: block;
            font-size: 1.4rem;
            font-weight: 500;
            color: rgba(255,255,255,0.6);
            letter-spacing: 0.08em;
            margin-bottom: 0.1rem;
        }

        /* "Sandipan" — large white bold */
        .hero-firstname {
            display: block;
            font-size: clamp(2.8rem, 8vw, 4.5rem);
            font-weight: 900;
            color: #ffffff;
            letter-spacing: -0.02em;
            text-shadow: 0 4px 30px rgba(167, 139, 250, 0.3);
            line-height: 1;
        }

        /* "Bhunia" wrapper — position relative for glow layer */
        .hero-lastname-wrapper {
            display: block;
            position: relative;
            line-height: 1.1;
            margin-top: 0.05rem;
        }

        /* "Bhunia" — vivid gradient text */
        .hero-lastname {
            display: block;
            font-size: clamp(3rem, 9vw, 5rem);
            font-weight: 900;
            letter-spacing: -0.03em;
            background: linear-gradient(135deg, #f093fb 0%, #ec4899 40%, #f5576c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
            z-index: 2;
        }

        /* Blurred glow copy behind the name */
        .hero-lastname-glow {
            display: block;
            font-size: clamp(3rem, 9vw, 5rem);
            font-weight: 900;
            letter-spacing: -0.03em;
            background: linear-gradient(135deg, #f093fb 0%, #ec4899 40%, #f5576c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: absolute;
            top: 0; left: 0;
            z-index: 1;
            filter: blur(20px);
            opacity: 0.65;
            animation: nameGlowPulse 3s ease-in-out infinite;
            pointer-events: none;
            user-select: none;
        }

        @keyframes nameGlowPulse {
            0%, 100% { filter: blur(20px); opacity: 0.65; }
            50%       { filter: blur(28px); opacity: 0.9; }
        }

        /* Mobile adjust */
        @media (max-width: 576px) {
            .hero-firstname { font-size: 2.6rem; }
            .hero-lastname, .hero-lastname-glow { font-size: 2.8rem; }
            .hero-im { font-size: 1.1rem; }
            .hero-greeting-text { font-size: 0.8rem; }
        }

        /* ============================================
           CV DOWNLOAD & VIEW BUTTONS
        ============================================ */
        .btn-cv-download {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #10b981, #059669);
            border: none;
            border-radius: 16px;
            padding: 14px 28px;
            color: #ffffff;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.35);
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .btn-cv-view {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            border: none;
            border-radius: 16px;
            padding: 14px 28px;
            color: #ffffff;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.35);
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
            cursor: pointer;
        }

        .btn-cv-download:hover {
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 15px 35px rgba(16, 185, 129, 0.5);
            color: #ffffff;
        }

        .btn-cv-view:hover {
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 15px 35px rgba(59, 130, 246, 0.5);
            color: #ffffff;
        }

        .btn-cv-download::before,
        .btn-cv-view::before {
            content: '';
            position: absolute;
            top: 0; left: -100%; width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-cv-download:hover::before,
        .btn-cv-view:hover::before { 
            left: 100%; 
        }

        /* CV Modal Styles */
        .cv-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .cv-modal.active {
            opacity: 1;
            visibility: visible;
        }

        .cv-modal-content {
            background: #ffffff;
            border-radius: 20px;
            padding: 2rem;
            max-width: 90vw;
            max-height: 90vh;
            width: 800px;
            position: relative;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
            transform: scale(0.9);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .cv-modal.active .cv-modal-content {
            transform: scale(1);
        }

        .dark-mode .cv-modal-content {
            background: #1f2937;
            color: #ffffff;
        }

        .cv-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e5e7eb;
        }

        .dark-mode .cv-modal-header {
            border-bottom-color: #374151;
        }

        .cv-modal-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
        }

        .dark-mode .cv-modal-title {
            color: #ffffff;
        }

        .cv-modal-close {
            width: 40px;
            height: 40px;
            border: none;
            background: #ef4444;
            color: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.2rem;
        }

        .cv-modal-close:hover {
            background: #dc2626;
            transform: scale(1.1) rotate(90deg);
        }

        .cv-viewer {
            width: 100%;
            height: 500px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            margin-bottom: 1.5rem;
        }

        .dark-mode .cv-viewer {
            border-color: #374151;
        }

        .cv-modal-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .cv-action-btn {
            padding: 12px 24px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .cv-download-btn {
            background: linear-gradient(135deg, #10b981, #059669);
            color: #ffffff;
        }

        .cv-download-btn:hover {
            background: linear-gradient(135deg, #059669, #047857);
            transform: translateY(-2px);
            color: #ffffff;
        }

        .cv-fullscreen-btn {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: #ffffff;
        }

        .cv-fullscreen-btn:hover {
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
            transform: translateY(-2px);
            color: #ffffff;
        }

        /* Mobile CV buttons */
        @media (max-width: 768px) {
            .btn-cv-download,
            .btn-cv-view {
                padding: 12px 20px;
                font-size: 0.9rem;
                flex: 1;
                margin-bottom: 0.5rem;
            }

            .d-flex.gap-2 {
                flex-direction: column;
                gap: 0.5rem !important;
            }

            .cv-modal-content {
                margin: 1rem;
                padding: 1.5rem;
                max-width: calc(100vw - 2rem);
            }

            .cv-viewer {
                height: 400px;
            }

            .cv-modal-actions {
                flex-direction: column;
            }

            .cv-action-btn {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .btn-cv-download,
            .btn-cv-view {
                padding: 10px 16px;
                font-size: 0.8rem;
            }
        }

        .hero-subtitle {
            text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.6);
            color: rgba(255, 255, 255, 0.95) !important;
            font-weight: 600 !important;
            font-size: 1.4rem !important; /* Larger subtitle */
            margin-bottom: 1.5rem !important;
            opacity: 0;
            animation: fadeInUp 1s ease-out 0.5s forwards;
        }

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

        /* Enhanced text visibility for all elements - PROFESSIONAL & READABLE */
        body:not(.dark-mode) .text-white {
            color: #ffffff !important;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.5);
            font-weight: 600;
        }

        body:not(.dark-mode) .text-white-50 {
            color: rgba(255, 255, 255, 0.95) !important;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
        }

        body:not(.dark-mode) .display-5 {
            color: #ffffff !important;
            text-shadow: 4px 4px 8px rgba(0, 0, 0, 0.6);
            font-weight: 800 !important;
            font-size: 2.2rem !important; /* Larger section titles */
        }

        body:not(.dark-mode) .lead {
            color: rgba(255, 255, 255, 0.95) !important;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
            font-weight: 500;
            font-size: 1.2rem !important; /* Larger lead text */
            line-height: 1.6;
            opacity: 0;
            animation: fadeInUp 1s ease-out 1s forwards;
        }

        /* Section headings enhancement - PROFESSIONAL */
        .section-title {
            color: #ffffff !important;
            text-shadow: 4px 4px 8px rgba(0, 0, 0, 0.6);
            font-size: 2.2rem !important; /* Larger section titles */
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 2px;
        }

        /* Dark mode text improvements */
        .dark-mode .hero-title {
            color: #ffffff !important;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            font-size: 3.5rem !important; /* Larger for dark mode too */
        }

        .dark-mode .hero-title span {
            color: var(--primary-color) !important;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        /* Mobile typography adjustments - BALANCED & PROFESSIONAL */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem !important; /* Larger on mobile */
            }
            
            .hero-subtitle {
                font-size: 1.1rem !important; /* Larger on mobile */
            }

            .display-5, .section-title {
                font-size: 1.8rem !important; /* Larger on mobile */
            }

            .lead {
                font-size: 1rem !important; /* Larger on mobile */
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 2.2rem !important; /* Still readable on small mobile */
            }

            .hero-subtitle {
                font-size: 1rem !important; /* Still readable on small mobile */
            }

            .display-5, .section-title {
                font-size: 1.6rem !important; /* Still readable on small mobile */
            }
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

        /* Enhanced Card Styles */
        .handmade-card {
            background: var(--light-card-bg);
            backdrop-filter: var(--blur-effect);
            -webkit-backdrop-filter: var(--blur-effect);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            box-shadow: var(--shadow-light);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .dark-mode .handmade-card {
            background: var(--dark-card-bg);
            border-color: rgba(255, 255, 255, 0.1);
            box-shadow: var(--shadow-dark);
        }

        .handmade-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color), var(--accent-color));
            transform: scaleX(0);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .handmade-card:hover::before {
            transform: scaleX(1);
        }

        .handmade-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
            border-color: rgba(255, 255, 255, 0.3);
        }

        /* Enhanced Navigation - COMPACT & PROFESSIONAL */
        .navbar-custom {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            z-index: 9999;
            background: transparent !important;
            transition: all 0.3s ease;
            padding: 0 1rem;
            height: 70px;
            min-height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: none;
        }

        .navbar-custom.scrolled {
            background: rgba(15, 23, 42, 0.6) !important;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.16);
        }

        .navbar-custom .navbar-inner {
            width: 100%;
            max-width: 1200px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .navbar-brand {
            font-size: 1.1rem !important;
            font-weight: 900 !important;
            color: #ffffff !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            letter-spacing: 0.8px;
            white-space: nowrap;
            overflow: hidden;
            max-width: 100%;
            border-radius: 0;
            margin: 0;
            padding: 0;
        }

        .navbar-brand:hover {
            color: #ffffff !important;
        }

        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .theme-toggle {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            background: rgba(255, 255, 255, 0.08);
            display: grid;
            place-items: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .theme-toggle:hover {
            background: rgba(255, 255, 255, 0.16);
        }

        .theme-toggle .fas {
            color: #ffffff;
            font-size: 16px;
        }

        .navbar-toggler {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            background: rgba(255, 255, 255, 0.14);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            padding: 0;
            transition: all 0.3s ease;
        }

        .navbar-toggler:hover {
            background: rgba(255, 255, 255, 0.20);
        }

        .navbar-toggler .hamburger-menu {
            width: 18px;
            height: 14px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .navbar-toggler .hamburger-menu span {
            display: block;
            width: 100%;
            height: 2px;
            background: #ffffff;
        }

        @media (max-width: 768px) {
            .navbar-custom {
                padding: 0 0.75rem;
                height: 70px;
                min-height: 70px;
                box-shadow: none;
            }

            .navbar-custom.scrolled {
                box-shadow: 0 12px 28px rgba(0, 0, 0, 0.16) !important;
            }

            .navbar-custom .navbar-inner {
                padding: 0;
            }

            .navbar-actions {
                gap: 8px;
            }

            .theme-toggle,
            .navbar-toggler {
                width: 34px;
                height: 34px;
                font-size: 16px;
            }

            .navbar-custom .navbar-collapse,
            .navbar-nav {
                display: none !important;
            }
        }

        @media (min-width: 992px) {
            .navbar-custom .navbar-toggler {
                display: none !important;
            }
        }

        /* Navigation Links Enhancement */

        /* Navigation Links Enhancement */
        .navbar-nav .nav-link {
            font-weight: 600;
            padding: 1rem 1.5rem !important;
            border-radius: 16px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            color: #ffffff !important;
            text-decoration: none;
            overflow: hidden;
        }

        .navbar-nav .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.2), rgba(236, 72, 153, 0.2));
            transition: left 0.4s ease;
            z-index: -1;
        }

        .navbar-nav .nav-link:hover::before {
            left: 0;
        }

        .navbar-nav .nav-link:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-3px) scale(1.05);
            color: #ffffff !important;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .navbar-custom.scrolled .nav-link {
            color: #374151 !important;
        }

        .navbar-custom.scrolled .nav-link:hover {
            color: #6366f1 !important;
            background: rgba(99, 102, 241, 0.1);
        }

        .dark-mode .navbar-custom.scrolled .nav-link {
            color: #e5e7eb !important;
        }

        .dark-mode .navbar-custom.scrolled .nav-link:hover {
            color: #a78bfa !important;
        }

        /* SUPER ATTRACTIVE Mobile Menu Button - UNIQUE DESIGN */
        .navbar-toggler {
            border: none !important;
            padding: 0;
            border-radius: 20px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.2), rgba(236, 72, 153, 0.2));
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            width: 65px;
            height: 65px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.2);
            margin-top: 4px;
        }

        .navbar-toggler::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.8s ease;
        }

        .navbar-toggler:hover::before {
            left: 100%;
        }

        .navbar-toggler:hover {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.3), rgba(236, 72, 153, 0.3));
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
            border-color: rgba(255, 255, 255, 0.4);
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 0.3rem rgba(99, 102, 241, 0.4);
        }

        .navbar-custom.scrolled .navbar-toggler {
            background: linear-gradient(135deg, rgba(31, 41, 55, 0.15), rgba(55, 65, 81, 0.15));
            border-color: rgba(31, 41, 55, 0.3);
        }

        .navbar-custom.scrolled .navbar-toggler:hover {
            background: linear-gradient(135deg, rgba(31, 41, 55, 0.25), rgba(55, 65, 81, 0.25));
        }

        .dark-mode .navbar-custom.scrolled .navbar-toggler {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.15));
            border-color: rgba(255, 255, 255, 0.2);
        }

        .dark-mode .navbar-custom.scrolled .navbar-toggler:hover {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.25));
        }

        /* UNIQUE Hamburger Animation - MORPHING DESIGN */
        .hamburger-menu {
            width: 32px;
            height: 24px;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            z-index: 2;
        }

        .hamburger-menu span {
            display: block;
            height: 3px;
            width: 100%;
            background: #ffffff;
            border-radius: 3px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: center;
            position: relative;
            overflow: hidden;
        }

        .hamburger-menu span::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, #6366f1, #ec4899, #06b6d4);
            border-radius: 3px;
            transition: left 0.6s ease;
        }

        .navbar-toggler:hover .hamburger-menu span::before {
            left: 0;
        }

        /* Unique morphing animation */
        .hamburger-menu span:nth-child(1) {
            width: 100%;
        }
        .hamburger-menu span:nth-child(2) {
            width: 80%;
            margin-left: auto;
        }
        .hamburger-menu span:nth-child(3) {
            width: 60%;
            margin-left: auto;
        }

        .navbar-toggler:hover .hamburger-menu span:nth-child(1) {
            width: 60%;
        }
        .navbar-toggler:hover .hamburger-menu span:nth-child(2) {
            width: 100%;
            margin-left: 0;
        }
        .navbar-toggler:hover .hamburger-menu span:nth-child(3) {
            width: 80%;
            margin-left: 0;
        }

        .navbar-custom.scrolled .hamburger-menu span {
            background: #1f2937;
        }

        .dark-mode .navbar-custom.scrolled .hamburger-menu span {
            background: #ffffff;
        }

        /* OPEN state animation - X formation */
        .navbar-toggler.menu-open .hamburger-menu span:nth-child(1) {
            transform: rotate(45deg) translate(8px, 8px);
            background: #ef4444;
            width: 100%;
        }
        .navbar-toggler.menu-open .hamburger-menu span:nth-child(2) {
            opacity: 0;
            transform: scaleX(0);
        }
        .navbar-toggler.menu-open .hamburger-menu span:nth-child(3) {
            transform: rotate(-45deg) translate(8px, -8px);
            background: #ef4444;
            width: 100%;
            margin-left: 0;
        }

        /* Pulsing effect when menu is open */
        .navbar-toggler.menu-open {
            animation: menuPulse 2s ease-in-out infinite;
        }

        @keyframes menuPulse {
            0%, 100% { 
                box-shadow: 0 8px 25px rgba(239, 68, 68, 0.3);
            }
            50% { 
                box-shadow: 0 8px 25px rgba(239, 68, 68, 0.6);
            }
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            padding: 0.75rem 1.25rem !important;
            border-radius: 12px;
            transition: all 0.3s ease;
            position: relative;
        }

        .navbar-nav .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        /* Enhanced Mobile Menu - FIXED FLASH ISSUE */
        @media (max-width: 991.98px) {
            /* Hide navbar links in mobile, only show menu button */
            .navbar-nav {
                display: none;
            }
            
            /* Mobile menu overlay - FULL SCREEN ATTRACTIVE MENU */
            .mobile-menu-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                background: linear-gradient(135deg, rgba(15, 23, 42, 0.98) 0%, rgba(30, 41, 59, 0.98) 50%, rgba(51, 65, 85, 0.98) 100%);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                z-index: 9999;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                opacity: 0;
                visibility: hidden;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                transform: scale(0.9);
            }
            
            .mobile-menu-overlay.active {
                opacity: 1;
                visibility: visible;
                transform: scale(1);
            }
            
            .dark-mode .mobile-menu-overlay {
                background: linear-gradient(135deg, rgba(5, 5, 20, 0.98) 0%, rgba(15, 15, 35, 0.98) 50%, rgba(25, 25, 45, 0.98) 100%);
            }
            
            /* Mobile menu close button */
            .mobile-menu-close {
                position: absolute;
                top: 2rem;
                right: 2rem;
                width: 50px;
                height: 50px;
                background: rgba(255, 255, 255, 0.1);
                border: 2px solid rgba(255, 255, 255, 0.2);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #ffffff;
                font-size: 1.2rem;
                cursor: pointer;
                transition: all 0.3s ease;
                z-index: 10000;
            }
            
            .mobile-menu-close:hover {
                background: rgba(255, 255, 255, 0.2);
                border-color: rgba(255, 255, 255, 0.4);
                transform: rotate(90deg) scale(1.1);
            }
            
            /* Mobile menu navigation */
            .mobile-nav-menu {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 1.5rem;
                padding: 2rem;
                max-width: 300px;
                width: 100%;
            }
            
            .mobile-nav-link {
                display: block;
                width: 100%;
                padding: 1.2rem 2rem;
                color: #ffffff !important;
                text-decoration: none;
                text-align: center;
                font-size: 1.1rem;
                font-weight: 600;
                background: rgba(255, 255, 255, 0.08);
                border: 2px solid rgba(255, 255, 255, 0.15);
                border-radius: 16px;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                overflow: hidden;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                transform: translateY(30px);
                opacity: 0;
            }
            
            .mobile-menu-overlay.active .mobile-nav-link {
                transform: translateY(0);
                opacity: 1;
            }
            
            /* Staggered animation for menu items */
            .mobile-nav-link:nth-child(1) { transition-delay: 0.1s; }
            .mobile-nav-link:nth-child(2) { transition-delay: 0.15s; }
            .mobile-nav-link:nth-child(3) { transition-delay: 0.2s; }
            .mobile-nav-link:nth-child(4) { transition-delay: 0.25s; }
            .mobile-nav-link:nth-child(5) { transition-delay: 0.3s; }
            .mobile-nav-link:nth-child(6) { transition-delay: 0.35s; }
            .mobile-nav-link:nth-child(7) { transition-delay: 0.4s; }
            
            .mobile-nav-link::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
                transition: left 0.6s ease;
            }
            
            .mobile-nav-link:hover::before {
                left: 100%;
            }
            
            .mobile-nav-link:hover {
                background: rgba(255, 255, 255, 0.15);
                border-color: rgba(255, 255, 255, 0.3);
                transform: translateY(-4px) scale(1.02);
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
                color: #ffffff !important;
            }
            
            /* Mobile menu brand */
            .mobile-menu-brand {
                position: absolute;
                top: 2rem;
                left: 2rem;
                font-size: 1.2rem;
                font-weight: 900;
                color: #ffffff;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            }
            
            .mobile-menu-brand .brand-initial {
                color: #a78bfa;
            }
            
            /* CV Download button in mobile menu */
            .mobile-cv-download {
                margin-top: 2rem;
                padding: 1rem 2rem;
                background: linear-gradient(135deg, #10b981, #059669);
                border: none;
                border-radius: 16px;
                color: #ffffff;
                font-weight: 600;
                text-decoration: none;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                transition: all 0.3s ease;
                box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
                transform: translateY(30px);
                opacity: 0;
            }
            
            .mobile-menu-overlay.active .mobile-cv-download {
                transform: translateY(0);
                opacity: 1;
                transition-delay: 0.5s;
            }
            
            .mobile-cv-download:hover {
                transform: translateY(-4px) scale(1.05);
                box-shadow: 0 15px 35px rgba(16, 185, 129, 0.4);
                color: #ffffff;
            }
            
            /* Hide desktop navbar collapse in mobile */
            .navbar-collapse {
                display: none !important;
            }
        }

        /* Professional Animations & Effects */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0%, 100% { 
                transform: translateY(0px) rotate(0deg); 
            }
            25% { 
                transform: translateY(-10px) rotate(1deg); 
            }
            50% { 
                transform: translateY(-20px) rotate(0deg); 
            }
            75% { 
                transform: translateY(-10px) rotate(-1deg); 
            }
        }

        @keyframes pulse {
            0%, 100% { 
                transform: scale(1); 
                opacity: 1;
            }
            50% { 
                transform: scale(1.05); 
                opacity: 0.8;
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-100px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.3) rotate(-10deg);
            }
            50% {
                opacity: 1;
                transform: scale(1.1) rotate(5deg);
            }
            100% {
                opacity: 1;
                transform: scale(1) rotate(0deg);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out;
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-pulse-custom {
            animation: pulse 2s ease-in-out infinite;
        }

        .animate-slide-left {
            animation: slideInLeft 0.8s ease-out;
        }

        .animate-slide-right {
            animation: slideInRight 0.8s ease-out;
        }

        .animate-bounce-in {
            animation: bounceIn 0.6s ease-out;
        }

        /* Profile Image Enhancements - ATTRACTIVE & ANIMATED */
        .profile-image {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            filter: drop-shadow(0 20px 40px rgba(0, 0, 0, 0.3));
            border: 4px solid transparent;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)) border-box;
            border-radius: 50%;
        }

        .profile-image:hover {
            transform: scale(1.05) rotate(2deg);
            filter: drop-shadow(0 25px 50px rgba(0, 0, 0, 0.4));
        }

        .profile-badge {
            animation: bounceIn 1s ease-out 0.5s both;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)) !important;
        }

        .profile-badge:hover {
            transform: scale(1.1) rotate(10deg);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.4);
        }

        /* Floating Elements for Visual Appeal */
        .floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .floating-element {
            position: absolute;
            animation: floatUpDown 6s ease-in-out infinite;
        }

        @keyframes floatUpDown {
            0%, 100% { 
                transform: translateY(0px) rotate(0deg); 
            }
            25% { 
                transform: translateY(-20px) rotate(5deg); 
            }
            50% { 
                transform: translateY(-40px) rotate(0deg); 
            }
            75% { 
                transform: translateY(-20px) rotate(-5deg); 
            }
        }

        /* Hide floating elements on mobile for cleaner look */
        @media (max-width: 768px) {
            .floating-elements {
                display: none;
            }
        }

        /* Section Animations */
        .section-animate {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease-out;
        }

        .section-animate.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Enhanced Card Styles - ATTRACTIVE & PROFESSIONAL */
        .handmade-card {
            background: var(--light-card-bg);
            backdrop-filter: var(--blur-effect);
            -webkit-backdrop-filter: var(--blur-effect);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px; /* More rounded for modern look */
            box-shadow: var(--shadow-light);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            padding: 2rem !important; /* More generous padding */
        }

        .dark-mode .handmade-card {
            background: var(--dark-card-bg);
            border-color: rgba(255, 255, 255, 0.1);
            box-shadow: var(--shadow-dark);
        }

        .handmade-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px; /* Thicker accent line */
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color), var(--accent-color));
            transform: scaleX(0);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .handmade-card:hover::before {
            transform: scaleX(1);
        }

        .handmade-card:hover {
            transform: translateY(-8px) scale(1.02); /* More pronounced hover effect */
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .handmade-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.6s ease;
        }

        .handmade-card:hover::after {
            left: 100%;
        }

        /* Professional card content */
        .handmade-card h5 {
            font-size: 1.25rem !important; /* Good readable size */
            margin-bottom: 1rem !important;
            font-weight: 700;
        }

        .handmade-card h6 {
            font-size: 1.1rem !important; /* Good readable size */
            margin-bottom: 0.75rem !important;
            font-weight: 600;
        }

        .handmade-card p {
            font-size: 1rem !important; /* Good readable size */
            margin-bottom: 1rem !important;
            line-height: 1.6;
        }

        .handmade-card .badge {
            font-size: 0.8rem !important; /* Good readable size */
            padding: 0.4rem 0.8rem !important;
            font-weight: 500;
        }

        .handmade-card small {
            font-size: 0.85rem !important; /* Good readable size */
        }

        /* Mobile card adjustments - PROFESSIONAL */
        @media (max-width: 768px) {
            .handmade-card {
                padding: 1.5rem !important; /* Good mobile padding */
                border-radius: 16px;
            }
            
            .handmade-card h5 {
                font-size: 1.1rem !important;
            }
            
            .handmade-card h6 {
                font-size: 1rem !important;
            }
            
            .handmade-card p {
                font-size: 0.9rem !important;
            }
            
            .handmade-card .badge {
                font-size: 0.75rem !important;
                padding: 0.3rem 0.6rem !important;
            }
        }

        /* Skills Progress - COMPACT */
        .skill-progress {
            height: 6px; /* Thinner progress bar */
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            overflow: hidden;
        }

        .skill-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 8px;
            transition: width 1s ease-in-out;
        }

        /* Mobile Responsive Improvements */
        @media (max-width: 768px) {
            .handmade-card {
                margin-bottom: 1.5rem;
                border-radius: 20px;
            }
            
            .hero-title {
                font-size: 2.5rem !important;
                line-height: 1.2;
            }
            
            .hero-subtitle {
                font-size: 1.1rem !important;
            }

            .display-5 {
                font-size: 1.8rem !important;
            }

            .btn-handmade {
                padding: 12px 24px; /* Good mobile size */
                font-size: 0.9rem;
            }

            .btn-outline-light {
                padding: 10px 20px; /* Good mobile size */
                font-size: 0.9rem;
            }

            .theme-toggle {
                width: 50px;
                height: 28px;
            }

            .theme-toggle::before {
                width: 20px;
                height: 20px;
            }

            .dark-mode .theme-toggle::before {
                transform: translateX(22px);
            }

            /* Footer Mobile Improvements */
            footer .col-lg-4,
            footer .col-lg-2,
            footer .col-lg-3 {
                margin-bottom: 2rem;
            }

            footer .contact-info .d-flex {
                margin-bottom: 1rem;
            }

            /* Mobile navbar brand fix */
            .navbar-brand {
                font-size: 1rem !important;
                white-space: nowrap;
                overflow: visible;
            }

            /* Mobile content spacing */
            section {
                padding-top: 3rem !important;
                padding-bottom: 3rem !important;
            }

            .container {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }

            /* Mobile profile image */
            #home img,
            #home .bg-primary.rounded-circle {
                width: 240px !important;
                height: 240px !important;
            }

            #home .profile-badge {
                padding: 0.75rem !important;
            }

            #home .fa-code {
                font-size: 1.5rem !important;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 2.2rem !important;
            }

            .hero-subtitle {
                font-size: 1rem !important;
            }

            .handmade-card {
                padding: 1.5rem !important;
            }

            .btn-handmade {
                width: 100%;
                margin-bottom: 0.75rem;
            }

            .d-flex.flex-column.flex-sm-row {
                flex-direction: column !important;
            }

            /* Mobile profile image */
            #home img,
            #home .bg-primary.rounded-circle {
                width: 200px !important;
                height: 200px !important;
            }
        }

        /* Enhanced Footer */
        footer {
            background: var(--light-footer-bg) !important;
            color: #ffffff !important;
            position: relative;
            overflow: hidden;
        }

        .dark-mode footer {
            background: var(--dark-footer-bg) !important;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color), var(--accent-color));
        }

        footer h5, footer h6 {
            color: #ffffff !important;
            font-weight: 700;
        }

        .footer-text {
            color: #e5e7eb !important;
            line-height: 1.6;
        }

        .footer-link {
            color: #d1d5db !important;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .footer-link:hover {
            color: var(--primary-color) !important;
            transform: translateY(-2px);
        }

        .footer-divider {
            border-color: rgba(255, 255, 255, 0.2) !important;
            margin: 2rem 0;
        }

        /* Contact Info Styling */
        .contact-info .fas {
            width: 20px;
            text-align: center;
        }

        /* Enhanced Hover Effects */
        .hover-primary {
            transition: all 0.3s ease;
        }

        .hover-primary:hover {
            color: var(--primary-color) !important;
            transform: translateY(-2px);
        }

        /* Badge Enhancements - COMPACT */
        .badge {
            font-weight: 500;
            padding: 0.3em 0.6em; /* Smaller padding */
            border-radius: 6px; /* Smaller border radius */
            font-size: 0.7rem; /* Smaller font size */
        }

        .bg-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)) !important;
        }

        .bg-secondary {
            background: linear-gradient(135deg, #6b7280, #9ca3af) !important;
        }

        /* Form Enhancements - COMPACT */
        .form-control {
            border-radius: 10px; /* Smaller border radius */
            border: 2px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            padding: 0.6rem 0.8rem; /* Smaller padding */
            transition: all 0.3s ease;
            font-size: 0.85rem; /* Smaller font size */
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.15rem rgba(99, 102, 241, 0.25); /* Smaller focus ring */
            background: rgba(255, 255, 255, 0.15);
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 0.4rem; /* Smaller margin */
            font-size: 0.85rem; /* Smaller font size */
        }

        /* Accessibility Improvements */
        .btn:focus,
        .nav-link:focus,
        .theme-toggle:focus {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }

        /* Enhanced Theme Toggle */
        .theme-toggle {
            width: 60px;
            height: 32px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            position: relative;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 6px;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .theme-toggle:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.05);
        }

        /* Theme toggle on scroll - LIGHT MODE */
        .navbar-custom.scrolled .theme-toggle {
            background: rgba(31, 41, 55, 0.1);
            border-color: rgba(31, 41, 55, 0.2);
        }

        .navbar-custom.scrolled .theme-toggle:hover {
            background: rgba(31, 41, 55, 0.2);
        }

        /* Theme toggle on scroll - DARK MODE */
        .dark-mode .navbar-custom.scrolled .theme-toggle {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .dark-mode .navbar-custom.scrolled .theme-toggle:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .theme-icon-light,
        .theme-icon-dark {
            font-size: 14px;
            transition: all 0.4s ease;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0;
            z-index: 2;
        }

        .theme-icon-light {
            color: #fbbf24;
            opacity: 1;
        }

        .theme-icon-dark {
            color: #6b7280;
        }

        .theme-toggle::before {
            content: '';
            position: absolute;
            width: 24px;
            height: 24px;
            background: linear-gradient(135deg, #ffffff, #f3f4f6);
            border-radius: 50%;
            top: 3px;
            left: 4px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .dark-mode .theme-toggle::before {
            transform: translateX(28px);
            background: linear-gradient(135deg, #374151, #1f2937);
        }

        .dark-mode .theme-icon-light {
            color: #6b7280;
            opacity: 0;
        }

        .dark-mode .theme-icon-dark {
            color: #fbbf24;
            opacity: 1;
        }

        /* Enhanced Button Styles - ATTRACTIVE & PROFESSIONAL */
        .btn-handmade {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 16px;
            padding: 16px 32px; /* More generous padding */
            color: white;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.3);
            font-size: 1rem; /* Good readable size */
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-handmade::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s ease;
        }

        .btn-handmade:hover::before {
            left: 100%;
        }

        .btn-handmade:hover {
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 15px 35px rgba(99, 102, 241, 0.4);
            color: white;
        }

        .btn-outline-light {
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 16px;
            padding: 14px 28px; /* Good padding */
            font-weight: 500;
            transition: all 0.3s ease;
            font-size: 1rem; /* Good readable size */
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-outline-light:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 255, 255, 0.2);
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
        /* Scroll to Top Button */
        .scroll-top-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ec4899, #8b5cf6);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.32);
            font-size: 1.15rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 18px 30px rgba(139, 92, 246, 0.24);
            z-index: 1100;
            opacity: 0;
            visibility: hidden;
            transform: translateY(24px) scale(0.92);
            transition: transform 0.3s ease, opacity 0.3s ease, visibility 0.3s ease, box-shadow 0.3s ease;
        }

        .scroll-top-btn.visible {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
            animation: floatButton 4s ease-in-out infinite;
        }

        .scroll-top-btn:hover {
            transform: translateY(-2px) scale(1.08);
            box-shadow: 0 20px 40px rgba(139, 92, 246, 0.35);
        }

        @keyframes floatButton {
            0%, 100% {
                transform: translateY(0) scale(1);
            }
            50% {
                transform: translateY(-4px) scale(1.02);
            }
        }

        @media (max-width: 768px) {
            .scroll-top-btn {
                bottom: 20px;
                right: 20px;
                width: 45px;
                height: 45px;
                font-size: 1rem;
            }
        }

        /* Final Navbar Override */
        .navbar-custom {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            width: 100% !important;
            z-index: 9999 !important;
            background: transparent !important;
            padding: 0 !important;
            margin: 0 !important;
            border-radius: 0 !important;
            box-shadow: none !important;
            transition: all 0.3s ease !important;
        }

        .navbar-custom.scrolled {
            background: rgba(15, 23, 42, 0.6) !important;
            backdrop-filter: blur(10px) !important;
            -webkit-backdrop-filter: blur(10px) !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.16) !important;
        }

        .navbar-custom .navbar-inner {
            width: 100% !important;
            max-width: none !important;
            padding: 0 1rem !important;
            margin: 0 auto !important;
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            gap: 8px !important;
        }

        .navbar-brand {
            border-radius: 0 !important;
            background: transparent !important;
            padding: 0 !important;
            margin: 0 !important;
            max-width: calc(100% - 100px) !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            white-space: nowrap !important;
        }

        @media (max-width: 768px) {
            .navbar-custom,
            .navbar-custom.scrolled,
            .navbar-custom .navbar-inner {
                background: transparent !important;
                box-shadow: none !important;
                backdrop-filter: none !important;
                -webkit-backdrop-filter: none !important;
            }

            .navbar-brand {
                background: rgba(255, 255, 255, 0.18) !important;
                color: #ffffff !important;
                padding: 0.35rem 0.85rem !important;
                border-radius: 14px !important;
                margin: 0 !important;
                max-width: calc(100% - 110px) !important;
                overflow: hidden !important;
                text-overflow: ellipsis !important;
                white-space: nowrap !important;
                display: inline-block !important;
                backdrop-filter: blur(12px) !important;
                -webkit-backdrop-filter: blur(12px) !important;
            }

            .navbar-actions {
                gap: 8px !important;
            }

            .theme-toggle,
            .navbar-toggler {
                width: 34px !important;
                height: 34px !important;
                border-radius: 10px !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            .theme-toggle {
                display: grid !important;
                place-items: center !important;
                background: rgba(255, 255, 255, 0.12) !important;
                border: 1px solid rgba(255, 255, 255, 0.18) !important;
            }

            .navbar-toggler {
                background: rgba(255, 255, 255, 0.14) !important;
                border: 1px solid rgba(255, 255, 255, 0.18) !important;
            }
        }

        .navbar-actions {
            gap: 8px !important;
        }

        .theme-toggle,
        .navbar-toggler {
            width: 34px !important;
            height: 34px !important;
            border-radius: 10px !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .theme-toggle {
            display: grid !important;
            place-items: center !important;
            background: rgba(255, 255, 255, 0.12) !important;
            border: 1px solid rgba(255, 255, 255, 0.18) !important;
        }

        .navbar-toggler {
            background: rgba(255, 255, 255, 0.14) !important;
            border: 1px solid rgba(255, 255, 255, 0.18) !important;
            margin-top: 4px !important;
        }

        body {
            padding-top: 70px !important;
        }

        main,
        section:first-of-type {
            padding-top: 70px !important;
        }
    </style>
</head>
<body>
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom" id="mainNavbar">
        <div class="navbar-inner d-flex justify-content-between align-items-center w-100">
            <a class="navbar-brand fw-bold mb-0 text-truncate" href="#home">
                <span class="brand-initial">S</span><span class="brand-name">andipan Bhunia</span>
            </a>
            
            <div class="navbar-actions d-flex align-items-center gap-2 flex-nowrap">
                <div class="theme-toggle" onclick="toggleTheme()" title="Toggle Dark/Light Mode">
                    <i class="fas fa-sun theme-icon-light"></i>
                    <i class="fas fa-moon theme-icon-dark"></i>
                </div>
                
                <button class="navbar-toggler" type="button" onclick="toggleMobileMenu()" aria-label="Toggle navigation">
                    <div class="hamburger-menu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </button>
            </div>
            
            <!-- Desktop Navigation -->
            <div class="collapse navbar-collapse order-lg-2 d-none d-lg-flex justify-content-center" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#about">About</a>
                    </li>
                    @if($projects->count() > 0)
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#projects">Projects</a>
                    </li>
                    @endif
                    @if($upcomingProjects->count() > 0)
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#upcoming">In the Lab</a>
                    </li>
                    @endif
                    @if($skills->count() > 0)
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#skills">Skills</a>
                    </li>
                    @endif
                    @if($qaAchievements->count() > 0)
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#qa-toolkit">QA Toolkit</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu-overlay" id="mobileMenuOverlay">
        <div class="mobile-menu-brand">
            <span class="brand-initial">S</span><span class="brand-name">andipan Bhunia</span>
        </div>
        
        <button class="mobile-menu-close" onclick="toggleMobileMenu()">
            <i class="fas fa-times"></i>
        </button>
        
        <div class="mobile-nav-menu">
            <a href="#home" class="mobile-nav-link" onclick="closeMobileMenu()">
                <i class="fas fa-home me-2"></i>Home
            </a>
            <a href="#about" class="mobile-nav-link" onclick="closeMobileMenu()">
                <i class="fas fa-user me-2"></i>About
            </a>
            @if($projects->count() > 0)
            <a href="#projects" class="mobile-nav-link" onclick="closeMobileMenu()">
                <i class="fas fa-code me-2"></i>Projects
            </a>
            @endif
            @if($upcomingProjects->count() > 0)
            <a href="#upcoming" class="mobile-nav-link" onclick="closeMobileMenu()">
                <i class="fas fa-flask me-2"></i>In the Lab
            </a>
            @endif
            @if($skills->count() > 0)
            <a href="#skills" class="mobile-nav-link" onclick="closeMobileMenu()">
                <i class="fas fa-cogs me-2"></i>Skills
            </a>
            @endif
            @if($qaAchievements->count() > 0)
            <a href="#qa-toolkit" class="mobile-nav-link" onclick="closeMobileMenu()">
                <i class="fas fa-bug me-2"></i>QA Toolkit
            </a>
            @endif
            <a href="#contact" class="mobile-nav-link" onclick="closeMobileMenu()">
                <i class="fas fa-envelope me-2"></i>Contact
            </a>
            
            <!-- CV Download in Mobile Menu -->
            @if(isset($publicCvs) && $publicCvs->count() > 0)
                @foreach($publicCvs as $cv)
                <a href="{{ $cv->download_url }}" class="mobile-cv-download" target="_blank" onclick="closeMobileMenu()">
                    <i class="fas fa-download me-2"></i>{{ $cv->label }}
                </a>
                @endforeach
            @endif
        </div>
    </div>

    <!-- CV Viewer Modal -->
    <div class="cv-modal" id="cvModal">
        <div class="cv-modal-content">
            <div class="cv-modal-header">
                <h3 class="cv-modal-title" id="cvModalTitle">CV Viewer</h3>
                <button class="cv-modal-close" onclick="closeCVModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <iframe class="cv-viewer" id="cvViewer" src="" frameborder="0"></iframe>
            
            <div class="cv-modal-actions">
                <a href="#" class="cv-action-btn cv-download-btn" id="cvDownloadBtn" target="_blank">
                    <i class="fas fa-download"></i>
                    Download CV
                </a>
                <button class="cv-action-btn cv-fullscreen-btn" onclick="openCVFullscreen()">
                    <i class="fas fa-expand"></i>
                    Open in New Tab
                </button>
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button -->
    <button id="scrollTopBtn" onclick="scrollToTop()" class="scroll-top-btn" title="Go to top">
        <i class="fas fa-chevron-up"></i>
    </button>

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
                            <a href="mailto:{{ $settings['email'] ?? 'sandipanbhunia18@gmail.com' }}" class="footer-link text-decoration-none" onclick="return confirmNavigation(event, 'Open your email app?')">
                                <small class="footer-text">{{ $settings['email'] ?? 'sandipanbhunia18@gmail.com' }}</small>
                            </a>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-phone text-primary me-2"></i>
                            <a href="tel:{{ $settings['phone'] ?? '+918972966158' }}" class="footer-link text-decoration-none" onclick="return confirmNavigation(event, 'Open dialer to call?')">
                                <small class="footer-text">{{ $settings['phone'] ?? '+91 8972966158' }}</small>
                            </a>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-map-marker-alt text-primary me-2 mt-1"></i>
                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($settings['location'] ?? 'Chaltatalya, Khejuri, Purba Medinipur, 721431, West Bengal, India') }}" target="_blank" rel="noopener noreferrer" class="footer-link text-decoration-none" onclick="return confirmNavigation(event, 'Open location in maps?')">
                                <small class="footer-text">{{ $settings['location'] ?? 'Chaltatalya, Khejuri, Purba Medinipur, 721431, West Bengal, India' }}</small>
                            </a>
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
        // Theme Toggle - Default to DARK mode for first-time visitors
        let isDarkMode = localStorage.getItem('darkMode') !== null 
            ? localStorage.getItem('darkMode') === 'true' 
            : true; // Default: dark mode
        
        function toggleTheme() {
            isDarkMode = !isDarkMode;
            localStorage.setItem('darkMode', isDarkMode);
            document.body.classList.toggle('dark-mode', isDarkMode);
        }
        
        // Initialize theme
        if (localStorage.getItem('darkMode') === null) {
            localStorage.setItem('darkMode', 'true');
            isDarkMode = true;
        }
        document.body.classList.toggle('dark-mode', isDarkMode);
        
        // Navbar scroll effect with proper class and fixed padding
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('mainNavbar');
            if (navbar) {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            }
        });

        // Mobile Menu Functions - SMOOTH & PROFESSIONAL
        let mobileMenuOpen = false;
        
        function toggleMobileMenu() {
            const overlay = document.getElementById('mobileMenuOverlay');
            const toggler = document.querySelector('.navbar-toggler');
            
            mobileMenuOpen = !mobileMenuOpen;
            
            if (mobileMenuOpen) {
                overlay.classList.add('active');
                toggler.classList.add('menu-open');
                document.body.style.overflow = 'hidden'; // Prevent background scroll
            } else {
                overlay.classList.remove('active');
                toggler.classList.remove('menu-open');
                document.body.style.overflow = ''; // Restore scroll
            }
        }
        
        function closeMobileMenu() {
            const overlay = document.getElementById('mobileMenuOverlay');
            const toggler = document.querySelector('.navbar-toggler');
            
            mobileMenuOpen = false;
            overlay.classList.remove('active');
            toggler.classList.remove('menu-open');
            document.body.style.overflow = '';
        }
        
        // Close mobile menu on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mobileMenuOpen) {
                closeMobileMenu();
            }
        });
        
        // Close mobile menu when clicking outside (on overlay background)
        document.getElementById('mobileMenuOverlay').addEventListener('click', function(e) {
            if (e.target === this) {
                closeMobileMenu();
            }
        });

        // CV Viewer Functions
        let currentCVUrl = '';
        
        function viewCV(cvId, cvLabel, cvUrl) {
            const modal = document.getElementById('cvModal');
            const title = document.getElementById('cvModalTitle');
            const viewer = document.getElementById('cvViewer');
            const downloadBtn = document.getElementById('cvDownloadBtn');
            
            // Use the view route for inline viewing
            const viewUrl = `/cv/view/${cvId}`;
            currentCVUrl = viewUrl;
            
            title.textContent = cvLabel;
            viewer.src = viewUrl;
            downloadBtn.href = `/cv/download/${cvId}`;
            
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        
        function closeCVModal() {
            const modal = document.getElementById('cvModal');
            const viewer = document.getElementById('cvViewer');
            
            modal.classList.remove('active');
            viewer.src = '';
            document.body.style.overflow = '';
        }
        
        function openCVFullscreen() {
            if (currentCVUrl) {
                window.open(currentCVUrl, '_blank');
            }
        }
        
        // Close CV modal on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modal = document.getElementById('cvModal');
                if (modal.classList.contains('active')) {
                    closeCVModal();
                }
            }
        });
        
        // Close CV modal when clicking outside
        document.getElementById('cvModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCVModal();
            }
        });

        // Mobile menu: auto-close when a nav link is clicked on mobile - REMOVED BOOTSTRAP DEPENDENCY
        document.addEventListener('DOMContentLoaded', function() {
            // No longer needed since we're using custom mobile menu
        });
        
        // Smooth scrolling with proper offset - COMPACT
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const navbarHeight = 70;
                    const targetPosition = target.offsetTop - navbarHeight - 20; // Reduced spacing
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Advanced scroll animations and navbar state
        function animateOnScroll() {
            var navbar = document.querySelector('.navbar-custom');
            var scrollTopBtn = document.getElementById('scrollTopBtn');
            var scrollPosition = window.scrollY;

            // Handle Navbar Scrolled State
            if (scrollPosition > 50) {
                if(navbar) navbar.classList.add('scrolled');
            } else {
                if(navbar) navbar.classList.remove('scrolled');
            }
            
            // Handle Scroll Top Button visibility
            if (scrollPosition > 150) {
                if(scrollTopBtn) scrollTopBtn.classList.add('visible');
            } else {
                if(scrollTopBtn) scrollTopBtn.classList.remove('visible');
            }

            const elements = document.querySelectorAll('.handmade-card, .section-animate');
            elements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const elementVisible = 150;
                
                if (elementTop < window.innerHeight - elementVisible) {
                    element.classList.add('animate-fadeInUp', 'visible');
                }
            });
        }
        
        // Intersection Observer for better performance
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fadeInUp', 'visible');
                }
            });
        }, observerOptions);
        
        // Observe elements for animation
        document.addEventListener('DOMContentLoaded', function() {
            const elementsToAnimate = document.querySelectorAll('.handmade-card, .section-animate');
            elementsToAnimate.forEach(el => observer.observe(el));
            
            // Add staggered animation delays
            document.querySelectorAll('.handmade-card').forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });
        
        window.addEventListener('scroll', animateOnScroll);
        
        // Scroll To Top Function
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
        
        // Confirm external actions for email, phone, and location links
        function confirmNavigation(event, message) {
            if (!confirm(message)) {
                event.preventDefault();
                return false;
            }
            return true;
        }

        // Contact form handler
        function handleContact(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);

            fetch('{{ route("contact") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(async response => {
                const data = await response.json();
                if (!response.ok) {
                    const message = data.message || 'Please check your form and try again.';
                    throw new Error(message);
                }
                return data;
            })
            .then(data => {
                if (data.success) {
                    alert('Message sent successfully! Thank you for reaching out.');
                    form.reset();
                } else {
                    throw new Error(data.message || 'Unable to send message.');
                }
            })
            .catch(error => {
                alert(error.message || 'Something went wrong! Please try again.');
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