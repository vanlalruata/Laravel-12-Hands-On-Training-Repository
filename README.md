# Laravel 12 Hands-On Training Repository

A comprehensive training repository for learning Laravel 12 framework through practical, hands-on projects. This repository contains complete curriculum materials for building real-world web applications.

## Training Programs

### 1. Laravel 12 Todo List Masterclass
**File:** `index.html`

A complete hands-on coding curriculum for building a production-ready Todo List application with:
- Full CRUD operations
- User authentication system
- Categories & priorities
- Search & filter functionality
- Responsive Tailwind CSS UI

### 2. Laravel 12 News CMS Training
**File:** `training.html`

Three-day intensive training for building a Content Management System (CMS) for a News Website:
- Article Management (CRUD)
- Category & Tag System
- User Authentication
- Responsive UI Design
- Publishing workflow

## Training Schedule

### Three-Day Program

| Day | Topic | Project |
|-----|-------|---------|
| Day 1 | Laravel Fundamentals & Setup | Todo List Basics |
| Day 2 | Database, CRUD & Auth | Article Management |
| Day 3 | CMS Development & Tailwind CSS | Complete News CMS |

**Duration:** 3 Days (16th - 18th February 2026)  
**Daily Time:** 10:00 AM - 4:00 PM

## Tech Stack

| Technology | Version |
|------------|---------|
| PHP | ≥ 8.2 |
| Laravel | 12.40 |
| Tailwind CSS | 4.x |
| MySQL | 8.0+ |
| Node.js | ≥ 20 |
| Composer | Latest |

## What You'll Learn

### Core Concepts
- Laravel 12 MVC architecture
- Eloquent ORM & database relationships
- Blade templating engine
- RESTful routing
- Form validation & error handling

### Development Skills
- Database migrations & seeders
- Middleware & authorization
- User authentication (Laravel Breeze)
- Responsive UI design with Tailwind CSS

### CMS Features
- Article management (Create, Read, Update, Delete)
- Category and tag organization
- Draft/Published status workflow
- Featured articles
- Search and filtering

## Getting Started

### Prerequisites
1. Install PHP 8.2 or higher
2. Install Composer
3. Install Node.js 20+
4. Install MySQL 8.0+

### Setup Instructions

#### For Todo List Training:
```bash
# Install Laravel Installer
composer global require laravel/installer

# Create new project
laravel new laravel_todo
cd laravel_todo

# Start development server
php artisan serve
```

#### For News CMS Training:
```bash
# Create new project
laravel new news_cms
cd news_cms

# Configure database in .env
DB_CONNECTION=mysql
DB_DATABASE=news_cms

# Run migrations
php artisan migrate
```

## Project Structure

```
training/
├── index.html          # Todo List Training Curriculum
├── training.html       # News CMS Training Curriculum
├── README.md           # This file
└── laravel_todo/      # Sample Laravel project
    ├── app/
    │   ├── Http/
    │   │   └── Controllers/
    │   └── Models/
    ├── database/
    │   ├── migrations/
    │   └── seeders/
    ├── resources/
    │   └── views/
    └── routes/
```

## Resource Person

**Dr. Vanlalruata Hnamte**
- Software Developer | Educator | Freelancer
- Experienced in PHP & Laravel-based application development
- Strong background in MVC architecture and RESTful design

## Training Objectives

By the end of this training, participants will be able to:

- Understand Laravel Framework architecture
- Install and configure Laravel development environment
- Work confidently with MVC pattern
- Implement authentication and authorization
- Develop CRUD-based CMS applications
- Use routes, controllers, models, migrations, and Eloquent ORM
- Design responsive UI using Tailwind CSS
- Build complete functional Laravel applications

## UI Framework

This training uses **Tailwind CSS 4.x** for styling:

### Quick CDN Setup
```html
<script src="https://cdn.tailwindcss.com"></script>
```

### Custom Configuration
```javascript
tailwind.config = {
    theme: {
        extend: {
            colors: {
                primary: {
                    50: '#eef2ff',
                    100: '#e0e7ff',
                    500: '#6366f1',
                    600: '#4f46e5',
                    700: '#4338ca',
                }
            }
        }
    }
}
```

## License

This training materials are available for educational purposes.

## Related Links

- [Laravel Documentation](https://laravel.com/docs/12.x)
- [Tailwind CSS](https://tailwindcss.com/)
- [PHP Official](https://www.php.net/)

---

**Note:** This repository contains hands-on training materials. The actual Laravel projects should be created separately following the step-by-step instructions in the HTML curriculum files.

Built with ❤️ using Laravel 12 & Tailwind CSS
