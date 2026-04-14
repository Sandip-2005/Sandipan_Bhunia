# Sandipan Bhunia - Portfolio Website

A high-end, animated, and fully dynamic portfolio built with Laravel 12, featuring a glassmorphism design, dual theme engine, and comprehensive admin dashboard.

## 🚀 Features

### Frontend Features
- **Dual Theme Engine**: Dark/Light mode toggle with localStorage persistence
- **Glassmorphism Design**: Modern glass-effect UI with Bento Box layouts
- **Smooth Animations**: AOS.js scroll animations and custom CSS animations
- **Responsive Design**: Perfect on mobile, tablet, and desktop
- **Interactive Elements**: SweetAlert2 popups and Alpine.js interactions
- **Sticky Navigation**: Blur-effect navbar that changes on scroll

### Content Management
- **Dynamic Project Showcase**: Manage completed projects with images, tech stack, and links
- **"In the Lab" Section**: Track upcoming projects with progress bars and completion dates
- **Skills Management**: Categorized skills with proficiency levels and icons
- **QA Toolkit**: Showcase testing achievements and bug-hunting skills
- **Settings Management**: Configurable site content and personal information

### Admin Features
- **Secret Admin Gateway**: Hidden login path (`/secret-gateway/login`)
- **Comprehensive Dashboard**: Overview of all content with quick stats
- **Image Upload System**: Direct upload to `public/uploads/` for shared hosting
- **Content Management**: Full CRUD operations for all content types
- **Responsive Admin Panel**: Dark-themed admin interface

## 🛠️ Tech Stack

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Tailwind CSS, Alpine.js, AOS.js
- **Database**: SQLite (easily changeable to MySQL)
- **Icons**: Font Awesome 6
- **Animations**: AOS.js + Custom CSS
- **Alerts**: SweetAlert2

## 📦 Installation

### Local Development

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd portfolio
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   php artisan migrate
   php artisan db:seed --class=PortfolioSeeder
   ```

5. **Create upload directories**
   ```bash
   mkdir -p public/uploads/projects
   mkdir -p public/uploads/skills
   ```

6. **Start development server**
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` to view the portfolio.

### Admin Access

- **URL**: `http://localhost:8000/secret-gateway/login`
- **Username**: `admin`
- **Password**: `portfolio2024`

## 🌐 Deployment to InfinityFree

### 1. Prepare Files
- Upload all files except `vendor/` and `node_modules/`
- Upload the provided `.htaccess` file to the public directory

### 2. Environment Configuration
Update `.env` for production:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_DATABASE=your-db-name
DB_USERNAME=your-db-user
DB_PASSWORD=your-db-password
```

### 3. Database Setup
```bash
php artisan migrate --force
php artisan db:seed --class=PortfolioSeeder --force
```

### 4. File Permissions
Ensure upload directories are writable:
```bash
chmod 755 public/uploads
chmod 755 public/uploads/projects
chmod 755 public/uploads/skills
```

## 📁 Project Structure

```
├── app/
│   ├── Http/Controllers/
│   │   ├── HomeController.php
│   │   └── Admin/
│   │       ├── AdminController.php
│   │       ├── ProjectController.php
│   │       ├── UpcomingProjectController.php
│   │       ├── SkillController.php
│   │       └── QaAchievementController.php
│   ├── Models/
│   │   ├── Project.php
│   │   ├── UpcomingProject.php
│   │   ├── Skill.php
│   │   ├── QaAchievement.php
│   │   └── Setting.php
│   └── Services/
│       └── ImageUploadService.php
├── database/
│   ├── migrations/
│   └── seeders/
│       └── PortfolioSeeder.php
├── resources/views/
│   ├── layout.blade.php
│   ├── home.blade.php
│   └── admin/
└── public/
    ├── uploads/
    └── .htaccess
```

## 🎨 Customization

### Theme Colors
Edit the Tailwind config in `layout.blade.php`:
```javascript
tailwind.config = {
    theme: {
        extend: {
            colors: {
                primary: {
                    500: '#3b82f6', // Change primary color
                    600: '#2563eb',
                    700: '#1d4ed8',
                }
            }
        }
    }
}
```

### Content Management
All content can be managed through the admin panel:
- **Projects**: Add/edit completed projects
- **In the Lab**: Manage upcoming projects with progress tracking
- **Skills**: Add technologies with proficiency levels
- **QA Achievements**: Showcase testing accomplishments
- **Settings**: Update personal information and site content

## 🔧 Key Features Explained

### Image Upload System
- Uses `ImageUploadService` for direct uploads to `public/uploads/`
- Generates unique filenames to prevent conflicts
- Supports common image formats (JPEG, PNG, GIF)
- Automatic cleanup when deleting records

### Progress Tracking
- Upcoming projects include progress bars (0-100%)
- Color-coded progress indicators
- Expected completion dates
- Status tracking (planning, in_progress, testing, delayed)

### Skills Proficiency
- 5-star rating system
- Category-based organization
- Icon support (emoji or Font Awesome)
- Featured skills highlighting

### QA Toolkit
- Achievement type categorization
- Bug count tracking
- Tool-specific icons
- Impact measurement
- Evidence link support

## 🚀 Performance Optimizations

- **CDN Assets**: All CSS/JS loaded from CDN for faster loading
- **Image Optimization**: Automatic image resizing and compression
- **Caching Headers**: Browser caching for static assets
- **Gzip Compression**: Enabled in `.htaccess`
- **Lazy Loading**: AOS animations load on scroll

## 🔒 Security Features

- **Hidden Admin Path**: Secret gateway instead of `/admin`
- **CSRF Protection**: All forms protected with CSRF tokens
- **File Upload Validation**: Strict image validation
- **Security Headers**: XSS protection, content type sniffing prevention
- **Environment Protection**: Sensitive files blocked in `.htaccess`

## 📱 Responsive Design

- **Mobile-First**: Optimized for mobile devices
- **Tablet Support**: Perfect tablet experience
- **Desktop Enhancement**: Full desktop feature set
- **Touch-Friendly**: Large touch targets and smooth interactions

## 🎯 SEO Optimized

- **Meta Tags**: Dynamic title and description
- **Semantic HTML**: Proper heading structure
- **Alt Tags**: All images include alt text
- **Clean URLs**: SEO-friendly URL structure
- **Performance**: Fast loading times

## 📞 Support

For any issues or customizations, contact:
- **Email**: sandipanbhunia18@gmail.com
- **GitHub**: https://github.com/Sandip-2005
- **LinkedIn**: https://linkedin.com/in/sandipan-bhunia/

## 📄 License

This project is open-source and available under the MIT License.

---

**Built with ❤️ by Sandipan Bhunia**