# 🚀 Sandipan Bhunia - Portfolio Website

A modern, responsive portfolio website built with Laravel 11, featuring a dark/light theme toggle, admin panel, and auto-deployment capabilities.

## ✨ Features

- **🎨 Modern Design**: Glassmorphism UI with smooth animations
- **🌓 Theme Toggle**: Dark/Light mode with persistent storage
- **📱 Mobile-First**: Fully responsive design
- **🔐 Admin Panel**: Secret admin gateway for content management
- **📊 Analytics**: Website visit tracking and statistics
- **🖼️ Media Management**: Profile photo and project image uploads
- **🚀 Auto-Deploy**: GitHub webhook integration for InfinityFree

## 🛠️ Tech Stack

- **Backend**: Laravel 11, PHP 8.2+
- **Frontend**: Bootstrap 5, Tailwind CSS (CDN), Vanilla JavaScript
- **Database**: MySQL (SQLite for local development)
- **Hosting**: InfinityFree (Free hosting with auto-deployment)
- **Version Control**: Git & GitHub

## 📋 Content Management

### Projects Showcase
- Featured projects with tech stack display
- GitHub and live demo links
- Project images and descriptions
- Sort order management

### "In the Lab" Section
- Work-in-progress projects
- Progress tracking (0-100%)
- Expected completion dates
- Status management (Planning, In Progress, Testing, etc.)

### Skills & Technologies
- Categorized skill display (Frontend, Backend, Database, etc.)
- Proficiency levels (1-5 stars)
- Icon support for visual appeal
- Featured skills highlighting

### QA Achievements
- Bug hunting accomplishments
- Automation achievements
- Performance improvements
- Tool-specific accomplishments (Selenium, Postman, etc.)

## 🚀 Quick Start

### Local Development
```bash
# Clone the repository
git clone https://github.com/yourusername/portfolio.git
cd portfolio

# Install dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database
php artisan migrate
php artisan db:seed --class=PortfolioSeeder

# Start development server
php artisan serve
```

### Access Points
- **Website**: http://localhost:8000
- **Admin Panel**: http://localhost:8000/secret-gateway/login
- **Default Credentials**: `admin` / `portfolio2024`

## 🌐 Deployment

### Option 1: Manual Deployment
```bash
# Prepare deployment package
./prepare-deployment.sh  # Linux/Mac
# or
prepare-deployment.bat   # Windows

# Upload the deployment-package/ contents to InfinityFree
```

### Option 2: Auto-Deployment (Recommended)
Set up GitHub webhook for automatic deployment on every push.

**📖 Complete Guide**: See [GITHUB_DEPLOYMENT_GUIDE.md](GITHUB_DEPLOYMENT_GUIDE.md)

## 📁 Project Structure

```
portfolio/
├── app/                    # Laravel application logic
│   ├── Http/Controllers/   # Controllers for web routes
│   ├── Models/            # Eloquent models
│   └── Services/          # Business logic services
├── database/              # Migrations and seeders
├── public/                # Public assets and uploads
├── resources/             # Views, CSS, and JS
│   └── views/            # Blade templates
├── routes/                # Route definitions
├── .htaccess             # Server configuration
├── deploy.php            # Auto-deployment script
└── README.md             # This file
```

## 🔐 Admin Features

### Dashboard
- Visit analytics and statistics
- Content overview (projects, skills, achievements)
- Quick action buttons
- Recent activity tracking

### Content Management
- **Projects**: Add, edit, delete completed projects
- **Lab Projects**: Manage work-in-progress items
- **Skills**: Technology proficiency management
- **QA Achievements**: Testing accomplishments
- **Settings**: Profile photo, contact info, social links

### Security
- Hidden admin path (`/secret-gateway/`)
- Session-based authentication
- CSRF protection
- File upload validation

## 🎨 Customization

### Theme Colors
Edit CSS variables in `resources/views/layout.blade.php`:
```css
:root {
    --primary-color: #3b82f6;
    --secondary-color: #8b5cf6;
    /* Add your custom colors */
}
```

### Personal Information
Update via Admin Panel → Settings or directly in the database.

## 📱 Mobile Features

- Touch-friendly admin interface
- Responsive navigation with mobile menu
- Optimized card layouts for small screens
- Fast loading with CDN assets

## 🔧 Configuration

### Environment Variables
Key settings in `.env`:
```env
APP_NAME="Your Portfolio Name"
APP_URL=https://yourdomain.com
DB_CONNECTION=mysql
# ... other settings
```

### Admin Credentials
Change default admin credentials in `AdminController`:
```php
if ($request->username === 'your_username' && $request->password === 'your_password') {
    // Authentication logic
}
```

## 🐛 Troubleshooting

### Common Issues
1. **500 Error**: Check file permissions (`chmod -R 755 storage/`)
2. **Database Connection**: Verify `.env` credentials
3. **File Uploads**: Ensure upload directories exist and are writable
4. **Admin Access**: Clear browser cache and check session configuration

### Debug Mode
For development, enable debug mode:
```env
APP_DEBUG=true
```

## 📊 Performance

### Optimization Features
- Route, config, and view caching
- Optimized Composer autoloader
- CDN assets (Bootstrap, Tailwind, Font Awesome)
- Image compression and validation
- Efficient database queries

### Caching Commands
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

## 👨‍💻 Developer

**Sandipan Bhunia**
- 📧 Email: sandipanbhunia18@gmail.com
- 🐙 GitHub: [@Sandip-2005](https://github.com/Sandip-2005)
- 💼 LinkedIn: [sandipan-bhunia](https://linkedin.com/in/sandipan-bhunia/)
- 🌐 Portfolio: [Live Demo](https://yourdomain.infinityfreeapp.com)

## 🎯 Roadmap

- [ ] Email contact form functionality
- [ ] Blog section for technical articles
- [ ] Multi-language support
- [ ] Advanced analytics dashboard
- [ ] API endpoints for mobile app
- [ ] Integration with GitHub API for automatic project sync

---

⭐ **Star this repository if you found it helpful!**

🚀 **Ready to deploy?** Check out the [deployment guide](GITHUB_DEPLOYMENT_GUIDE.md) for step-by-step instructions.