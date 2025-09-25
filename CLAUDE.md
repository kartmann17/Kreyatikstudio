# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

# Kreyatik Studio Laravel Application

Business management application built on Laravel for Kreyatik Studio, including client management, project tracking, ticketing system, and content management.

## Tech Stack

- **Backend**: Laravel 12.x with PHP 8.2+
- **Frontend**: Tailwind CSS 4.x with Vite
- **Database**: SQLite (migration-based)
- **Authentication**: Laravel UI with role-based access
- **SEO**: ralphjsmit/laravel-seo package
- **Cookie Consent**: devrabiul/laravel-cookie-consent

## Core Features

- **Admin Dashboard**: Full CRUD for clients/projects/tickets with statistics
- **Client Portal**: Limited access to own projects and ticket creation
- **Blog System**: Articles with SEO optimization and file uploads
- **Portfolio Showcase**: Public portfolio display
- **Contact Management**: Form submissions with email notifications
- **Time Tracking**: Task-based time logging with expense tracking
- **Pricing Plans**: Service pricing management

## Architecture & Key Patterns

### Role-Based Access Control
- **Admin Role**: Full system access with dashboard at `/admin`
- **Client Role**: Limited access via client portal at `/client` 
- **User Model**: Contains role field (`admin`, `staff`, `client`) with helper methods `isAdmin()`, `isStaff()`, `isClient()`
- **Client Users**: Linked to `Client` model via `client_id` foreign key

### Controller Organization
```
app/Http/Controllers/
├── Admin/           # Admin-only controllers with full CRUD
├── Client/          # Client portal controllers (limited access)
├── Auth/            # Laravel UI authentication
├── Api/             # API endpoints (e.g., n8n article publishing)
└── [Public]/        # Public facing controllers (welcome, blog, contact)
```

### Key Model Relationships
- `User` belongsTo `Client` (for client users)
- `Project` belongsTo `Client` and `User` (responsible user)
- `Project` hasMany `Task` and `TimeLog`
- `Ticket` belongsTo `Client` with hasMany `TicketComment`
- `Article` uses SEO traits from ralphjsmit/laravel-seo

### File Storage Structure
- Portfolio media: `public/storage/portfolio/`
- Article images: `public/storage/articles/`
- SEO images: `public/storage/seo/`
- General uploads: `storage/app/public/` (symlinked to `public/storage/`)

## Development Commands

### Running the Application
```bash
# Start development server with all services (uses concurrently)
composer dev

# Individual services
php artisan serve                    # Laravel server
php artisan queue:listen --tries=1   # Queue worker
npm run dev                          # Vite dev server

# Build for production
npm run build
```

### Testing
```bash
# Run all tests (clears config first)
composer test

# Run Laravel tests directly
php artisan test

# Run specific test file
php artisan test tests/Feature/ClientTest.php
```

### Code Quality & Caching
```bash
# Format code with Laravel Pint
vendor/bin/pint

# Clear individual caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Clear all caches at once (custom command)
php artisan cache:clear-all
```

### Database Operations
```bash
# Run migrations
php artisan migrate

# Fresh database with seeders
php artisan migrate:fresh --seed

# Run seeders only
php artisan db:seed
```

### Custom Artisan Commands
```bash
# Generate sitemap.xml
php artisan sitemap:generate

# Clear all application caches (config, cache, routes, views, optimize)
php artisan cache:clear-all
```

## Core Models & Relationships

### User Management
- `User` - Admin/staff/client users with role-based permissions and client association
- `Client` - Client companies with multiple associated users and projects

### Project & Task Management  
- `Project` - Client projects with progress tracking, time logging, and SEO metadata
- `Task` - Project tasks with individual progress and time tracking
- `TimeLog` - Detailed time tracking entries linked to projects/tasks
- `Expense` - Business expense tracking

### Support System
- `Ticket` - Support tickets with client association and priority levels
- `TicketComment` - Threaded comments on support tickets

### Content Management
- `Article` - Blog articles with SEO optimization using ralphjsmit/laravel-seo
- `PortfolioItem` - Portfolio showcase items with file uploads
- `PricingPlan` - Service pricing plans for public display
- `ContactMessage` - Contact form submissions with email notifications

## View Structure

### Admin Interface (`resources/views/admin/`)
- Complete CRUD interfaces for all entities
- Dashboard with statistics and recent activity
- User management with role assignment

### Client Portal (`resources/views/client/`)
- Limited dashboard showing only client's projects
- Project viewing (read-only)
- Ticket creation and management
- Profile management

### Public Views (`resources/views/`)
- Homepage with service showcase
- Blog with SEO-optimized articles
- Portfolio display
- Contact form
- Legal pages (CGV, privacy policy, etc.)

## Key Configuration Files

- `config/seo.php` - SEO package configuration
- `config/laravel-cookie-consent.php` - GDPR cookie consent
- Database: SQLite at `database/database.sqlite`

## Testing Structure

Feature tests covering core business logic:
- `ClientTest` - Client CRUD operations
- `ProjectTest` - Project management workflows  
- `TaskTest` - Task operations and time tracking
- `TimeLogTest` - Time logging functionality

Run with: `composer test` (includes config clearing)