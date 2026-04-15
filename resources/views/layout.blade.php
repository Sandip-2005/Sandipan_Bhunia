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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--light-bg);
            min-height: 100vh;
            overflow-x: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            line-height: 1.6;
            padding-top: 75px; /* Reduced padding for better spacing */
        }

        body.dark-mode {
            background: var(--dark-bg);
            color: var(--text-light);
        }

        /* Fix main content positioning */
        main {
            position: relative;
            z-index: 1;
        }

        /* Ensure sections don't overlap with navbar - ULTRA COMPACT GAPS */
        section {
            scroll-margin-top: 90px; /* Reduced offset */
            padding: 1.5rem 0; /* Much smaller section padding */
        }

        /* Fix hero section height calculation - BETTER SPACING */
        #home {
            min-height: calc(100vh - 75px);
            padding-top: 1rem; /* Reduced top padding */
            display: flex;
            align-items: center;
        }

        /* Mobile spacing adjustments */
        @media (max-width: 768px) {
            body {
                padding-top: 70px; /* Smaller padding on mobile */
            }
            
            section {
                padding: 1rem 0; /* Much smaller padding on mobile */
            }
            
            #home {
                min-height: calc(100vh - 70px);
                padding-top: 0.5rem;
            }
        }

        /* Enhanced Typography with Better Visibility - ULTRA COMPACT SIZES */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 700;
            letter-spacing: -0.025em;
        }

        .display-3 {
            font-weight: 800;
            letter-spacing: -0.05em;
            font-size: 2rem !important; /* Much smaller hero title */
        }

        .display-5 {
            font-size: 1.4rem !important; /* Much smaller section titles */
        }

        /* Hero title visibility improvements - ULTRA COMPACT */
        .hero-title {
            color: #ffffff !important;
            font-weight: 900 !important;
            text-shadow: 4px 4px 8px rgba(0, 0, 0, 0.8);
            font-size: 2rem !important; /* Much smaller hero title */
        }

        .hero-title span {
            color: var(--primary-color) !important;
            text-shadow: 4px 4px 8px rgba(0, 0, 0, 0.8);
            font-weight: 900 !important;
        }

        .hero-subtitle {
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.6);
            color: rgba(255, 255, 255, 0.95) !important;
            font-weight: 600 !important;
            font-size: 0.95rem !important; /* Much smaller subtitle */
        }

        /* Enhanced text visibility for all elements - ULTRA COMPACT */
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
            font-size: 1.4rem !important; /* Much smaller section titles */
        }

        body:not(.dark-mode) .lead {
            color: rgba(255, 255, 255, 0.95) !important;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
            font-weight: 500;
            font-size: 0.9rem !important; /* Much smaller lead text */
        }

        /* Section headings enhancement - ULTRA COMPACT */
        .section-title {
            color: #ffffff !important;
            text-shadow: 4px 4px 8px rgba(0, 0, 0, 0.6);
            font-size: 1.4rem !important; /* Much smaller section titles */
        }

        /* Dark mode text improvements */
        .dark-mode .hero-title {
            color: #ffffff !important;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            font-size: 2rem !important; /* Much smaller */
        }

        .dark-mode .hero-title span {
            color: var(--primary-color) !important;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        /* Mobile typography adjustments - ULTRA COMPACT */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 1.6rem !important; /* Much smaller on mobile */
            }
            
            .hero-subtitle {
                font-size: 0.85rem !important; /* Much smaller on mobile */
            }

            .display-5, .section-title {
                font-size: 1.2rem !important; /* Much smaller on mobile */
            }

            .lead {
                font-size: 0.8rem !important; /* Much smaller on mobile */
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 1.4rem !important; /* Even smaller on small mobile */
            }

            .hero-subtitle {
                font-size: 0.8rem !important; /* Even smaller on small mobile */
            }

            .display-5, .section-title {
                font-size: 1.1rem !important; /* Even smaller on small mobile */
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
            background: var(--light-navbar-bg) !important;
            backdrop-filter: var(--blur-effect);
            -webkit-backdrop-filter: var(--blur-effect);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 0.8rem 0; /* Reduced padding */
            height: 75px; /* Reduced navbar height */
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1050;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .dark-mode .navbar-custom {
            background: var(--dark-navbar-bg) !important;
        }

        .navbar-scrolled {
            background: rgba(255, 255, 255, 0.98) !important;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            padding: 0.6rem 0; /* Reduced scrolled padding */
            height: 65px; /* Smaller when scrolled */
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .dark-mode .navbar-scrolled {
            background: rgba(15, 15, 35, 0.98) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Enhanced navbar brand - ULTRA COMPACT & SUPER VISIBLE */
        .navbar-brand {
            font-size: 1.1rem !important; /* Smaller but still visible */
            font-weight: 900 !important;
            color: #ffffff !important;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.2rem;
            text-shadow: 4px 4px 8px rgba(0, 0, 0, 0.9); /* Extra strong shadow for visibility */
            letter-spacing: 0.8px; /* Better letter spacing for readability */
            text-transform: none; /* Ensure proper casing */
            white-space: nowrap; /* Prevent text wrapping */
            overflow: visible; /* Ensure text is not cut off */
            max-width: none; /* Remove any width restrictions */
        }

        .navbar-brand:hover {
            transform: scale(1.05);
            color: #ffffff !important;
        }

        .navbar-scrolled .navbar-brand {
            color: #1f2937 !important;
            font-size: 1rem !important; /* Slightly smaller when scrolled */
            text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.9); /* Strong light shadow on light background */
            font-weight: 900 !important;
        }

        .dark-mode .navbar-scrolled .navbar-brand {
            color: #ffffff !important;
            text-shadow: 4px 4px 8px rgba(0, 0, 0, 0.9); /* Strong dark shadow on dark background */
        }

        /* Mobile navbar brand - ENSURE VISIBILITY */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1rem !important; /* Smaller but readable on mobile */
                letter-spacing: 0.5px;
            }
            
            .navbar-scrolled .navbar-brand {
                font-size: 0.95rem !important;
            }
        }

        /* Extra small mobile - MINIMUM READABLE SIZE */
        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 0.95rem !important;
                letter-spacing: 0.3px;
            }
            
            .navbar-scrolled .navbar-brand {
                font-size: 0.9rem !important;
            }
        }

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

        .navbar-scrolled .nav-link {
            color: #374151 !important;
        }

        .navbar-scrolled .nav-link:hover {
            color: #6366f1 !important;
            background: rgba(99, 102, 241, 0.1);
        }

        .dark-mode .navbar-scrolled .nav-link {
            color: #e5e7eb !important;
        }

        .dark-mode .navbar-scrolled .nav-link:hover {
            color: #a78bfa !important;
        }

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1.4rem !important;
            }
            
            body {
                padding-top: 80px; /* Adjusted for mobile */
            }
            
            .navbar-custom {
                height: 80px; /* Consistent mobile navbar */
                padding: 1rem 0;
            }
            
            #home {
                min-height: calc(100vh - 80px);
                padding-top: 1rem;
            }
        }

        /* Animated Menu Button - STYLISH & PROFESSIONAL */
        .navbar-toggler {
            border: none !important;
            padding: 0.75rem;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.15);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .navbar-toggler::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s ease;
        }

        .navbar-toggler:hover::before {
            left: 100%;
        }

        .navbar-toggler:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 0.3rem rgba(99, 102, 241, 0.3);
        }

        .navbar-scrolled .navbar-toggler {
            background: rgba(31, 41, 55, 0.1);
        }

        .dark-mode .navbar-scrolled .navbar-toggler {
            background: rgba(255, 255, 255, 0.1);
        }

        /* Advanced Hamburger Animation */
        .hamburger-menu {
            width: 28px;
            height: 20px;
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
        }

        .hamburger-menu span::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background: linear-gradient(90deg, #6366f1, #ec4899);
            border-radius: 3px;
            transition: width 0.3s ease;
        }

        .navbar-toggler:hover .hamburger-menu span::before {
            width: 100%;
        }

        .navbar-scrolled .hamburger-menu span {
            background: #1f2937;
        }

        .dark-mode .navbar-scrolled .hamburger-menu span {
            background: #ffffff;
        }

        /* Hamburger Animation States */
        .navbar-toggler[aria-expanded="true"] .hamburger-menu span:nth-child(1) {
            transform: rotate(45deg) translate(7px, 7px);
            background: #ef4444;
        }

        .navbar-toggler[aria-expanded="true"] .hamburger-menu span:nth-child(2) {
            opacity: 0;
            transform: scale(0) rotate(180deg);
        }

        .navbar-toggler[aria-expanded="true"] .hamburger-menu span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -7px);
            background: #ef4444;
        }
        }

        .hamburger-menu span {
            display: block;
            height: 3px;
            width: 100%;
            background: #ffffff;
            border-radius: 2px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: center;
        }

        /* Fix hamburger color on scroll - LIGHT MODE */
        .navbar-scrolled .hamburger-menu span {
            background: #1f2937; /* Dark hamburger on light background */
        }

        /* Fix hamburger color on scroll - DARK MODE */
        .dark-mode .navbar-scrolled .hamburger-menu span {
            background: #ffffff; /* White hamburger on dark background */
        }

        .navbar-toggler[aria-expanded="true"] .hamburger-menu span:nth-child(1) {
            transform: rotate(45deg) translate(6px, 6px);
        }

        .navbar-toggler[aria-expanded="true"] .hamburger-menu span:nth-child(2) {
            opacity: 0;
            transform: scale(0);
        }

        .navbar-toggler[aria-expanded="true"] .hamburger-menu span:nth-child(3) {
            transform: rotate(-45deg) translate(6px, -6px);
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

        /* Mobile Menu Enhancements */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: var(--blur-effect);
                border-radius: 16px;
                margin-top: 1rem;
                padding: 1rem;
                border: 1px solid rgba(255, 255, 255, 0.2);
                animation: slideDown 0.3s ease-out;
            }

            .dark-mode .navbar-collapse {
                background: rgba(0, 0, 0, 0.3);
            }

            .navbar-nav .nav-link {
                margin: 0.25rem 0;
                text-align: center;
                padding: 1rem !important;
            }

            @keyframes slideDown {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
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

        /* Profile Image Enhancements */
        .profile-image {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            filter: drop-shadow(0 20px 40px rgba(0, 0, 0, 0.3));
        }

        .profile-image:hover {
            transform: scale(1.05) rotate(2deg);
            filter: drop-shadow(0 25px 50px rgba(0, 0, 0, 0.4));
        }

        .profile-badge {
            animation: bounceIn 1s ease-out 0.5s both;
            transition: all 0.3s ease;
        }

        .profile-badge:hover {
            transform: scale(1.1) rotate(10deg);
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)) !important;
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

        /* Enhanced Card Styles - ULTRA COMPACT SIZE */
        .handmade-card {
            background: var(--light-card-bg);
            backdrop-filter: var(--blur-effect);
            -webkit-backdrop-filter: var(--blur-effect);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px; /* Much smaller border radius */
            box-shadow: var(--shadow-light);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            padding: 1rem !important; /* Much smaller padding */
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
            height: 2px; /* Thinner accent line */
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color), var(--accent-color));
            transform: scaleX(0);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .handmade-card:hover::before {
            transform: scaleX(1);
        }

        .handmade-card:hover {
            transform: translateY(-4px) scale(1.005); /* Much smaller hover effect */
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
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

        /* Ultra compact card content */
        .handmade-card h5 {
            font-size: 0.95rem !important; /* Much smaller headings */
            margin-bottom: 0.5rem !important;
        }

        .handmade-card h6 {
            font-size: 0.85rem !important; /* Much smaller subheadings */
            margin-bottom: 0.5rem !important;
        }

        .handmade-card p {
            font-size: 0.8rem !important; /* Much smaller text */
            margin-bottom: 0.5rem !important;
            line-height: 1.4;
        }

        .handmade-card .badge {
            font-size: 0.65rem !important; /* Much smaller badges */
            padding: 0.2rem 0.4rem !important;
        }

        .handmade-card small {
            font-size: 0.7rem !important; /* Much smaller small text */
        }

        /* Mobile card adjustments - ULTRA COMPACT */
        @media (max-width: 768px) {
            .handmade-card {
                padding: 0.8rem !important; /* Even smaller padding on mobile */
                border-radius: 10px;
            }
            
            .handmade-card h5 {
                font-size: 0.9rem !important;
            }
            
            .handmade-card h6 {
                font-size: 0.8rem !important;
            }
            
            .handmade-card p {
                font-size: 0.75rem !important;
            }
            
            .handmade-card .badge {
                font-size: 0.6rem !important;
                padding: 0.15rem 0.3rem !important;
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
                font-size: 1.3rem !important;
            }

            .display-5 {
                font-size: 2rem !important;
            }

            .btn-handmade {
                padding: 8px 16px; /* Much smaller on mobile */
                font-size: 0.8rem;
            }

            .btn-outline-light {
                padding: 6px 14px; /* Much smaller on mobile */
                font-size: 0.8rem;
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

            /* Navbar brand mobile fix */
            .navbar-brand {
                font-size: 1.4rem !important;
                white-space: nowrap;
                overflow: visible;
            }

            /* Mobile content spacing */
            section {
                padding-top: 3rem !important;
                padding-bottom: 3rem !important;
            }

            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 2rem !important;
            }

            .hero-subtitle {
                font-size: 1.1rem !important;
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

            /* Mobile navbar brand fix */
            .navbar-brand {
                font-size: 1.2rem !important;
                max-width: none !important;
                flex: 1;
            }

            .navbar .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            /* Ensure navbar content doesn't overflow */
            .navbar-nav {
                width: 100%;
            }

            .d-flex.align-items-center.order-lg-3 {
                flex-shrink: 0;
            }

            /* Mobile section spacing */
            section {
                padding-top: 2rem !important;
                padding-bottom: 2rem !important;
            }

            /* Mobile hero adjustments */
            #home .col-lg-6:first-child {
                margin-bottom: 2rem;
            }

            #home .col-lg-6:last-child {
                margin-top: 1rem;
            }

            /* Mobile profile image - ULTRA COMPACT */
            #home img,
            #home .bg-primary.rounded-circle {
                width: 160px !important;
                height: 160px !important;
            }

            #home .profile-badge {
                padding: 0.5rem !important;
            }

            #home .fa-code {
                font-size: 1rem !important;
            }
        }

        /* Extra small devices */
        @media (max-width: 375px) {
            .hero-title {
                font-size: 1.8rem !important;
            }

            .display-5 {
                font-size: 1.5rem !important;
            }

            .navbar-brand {
                font-size: 1.1rem !important;
            }

            #home img,
            #home .bg-primary.rounded-circle {
                width: 140px !important;
                height: 140px !important;
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
        .navbar-scrolled .theme-toggle {
            background: rgba(31, 41, 55, 0.1);
            border-color: rgba(31, 41, 55, 0.2);
        }

        .navbar-scrolled .theme-toggle:hover {
            background: rgba(31, 41, 55, 0.2);
        }

        /* Theme toggle on scroll - DARK MODE */
        .dark-mode .navbar-scrolled .theme-toggle {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .dark-mode .navbar-scrolled .theme-toggle:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .theme-icon-light,
        .theme-icon-dark {
            font-size: 14px;
            transition: all 0.4s ease;
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
        }

        .dark-mode .theme-icon-dark {
            color: #fbbf24;
        }

        /* Enhanced Button Styles - ULTRA COMPACT */
        .btn-handmade {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 12px; /* Smaller border radius */
            padding: 10px 24px; /* Smaller padding */
            color: white;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 3px 15px rgba(99, 102, 241, 0.3); /* Smaller shadow */
            font-size: 0.85rem; /* Smaller font size */
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
            transform: translateY(-2px) scale(1.03); /* Smaller hover effect */
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4);
            color: white;
        }

        .btn-outline-light {
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 12px; /* Smaller border radius */
            padding: 8px 20px; /* Smaller padding */
            font-weight: 500;
            transition: all 0.3s ease;
            font-size: 0.85rem; /* Smaller font size */
        }

        .btn-outline-light:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-1px); /* Smaller hover effect */
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
                <span style="color: var(--primary-color); font-weight: 900;">S</span><span style="font-weight: 900;">andipan Bhunia</span>
            </a>
            
            <div class="d-flex align-items-center order-lg-3">
                <!-- Theme Toggle -->
                <div class="theme-toggle me-3" onclick="toggleTheme()" title="Toggle Dark/Light Mode">
                    <i class="fas fa-sun theme-icon-light"></i>
                    <i class="fas fa-moon theme-icon-dark"></i>
                </div>
                
                <!-- Mobile Menu Button -->
                <button class="navbar-toggler border-0 p-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="hamburger-menu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
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
        // Theme Toggle - Default to LIGHT mode
        let isDarkMode = localStorage.getItem('darkMode') === 'true' || false; // Default to false (light mode)
        
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
        
        // Initialize theme - Start with LIGHT mode by default
        if (localStorage.getItem('darkMode') === null) {
            localStorage.setItem('darkMode', 'false');
            isDarkMode = false;
        }
        document.body.classList.toggle('dark-mode', isDarkMode);
        
        // Navbar scroll effect with proper height handling - COMPACT
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('mainNavbar');
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
                // Adjust body padding when navbar height changes
                document.body.style.paddingTop = window.innerWidth <= 576 ? '60px' : '65px';
            } else {
                navbar.classList.remove('navbar-scrolled');
                // Reset body padding to original navbar height
                document.body.style.paddingTop = window.innerWidth <= 576 ? '70px' : '75px';
            }
        });
        
        // Smooth scrolling with proper offset - COMPACT
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const navbarHeight = window.innerWidth <= 576 ? 70 : 75;
                    const targetPosition = target.offsetTop - navbarHeight - 20; // Reduced spacing
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Advanced scroll animations
        function animateOnScroll() {
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