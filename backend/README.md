# 🩸 BloodBank Backend API

A robust Laravel-based REST API for managing blood donors, donations, and administrative operations in the BloodBank application.

## 🚀 Technology Stack

-   **Framework**: Laravel 12 with PHP 8.2+
-   **Database**: MySQL 8.0
-   **Cache & Queue**: Redis
-   **Authentication**: Laravel Sanctum
-   **Monitoring**: Laravel Telescope

## 📋 Requirements

-   PHP 8.2 or higher
-   Composer
-   MySQL 8.0+
-   Redis server
-   Node.js & npm (for frontend assets)

## 🛠️ Installation & Setup

### 1. Navigate to Backend Directory
```bash
cd backend
```

### 2. Install Dependencies
```bash
composer install
npm install  # Required for compiling frontend assets (CSS/JS) used in Laravel views
```

### 3. Environment Configuration
```bash
# Copy the example environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

**Important**: Update your `.env` file with your local machine configuration:
- Database credentials (DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD)
- Redis configuration (REDIS_HOST, REDIS_PASSWORD, REDIS_PORT)
- Mail settings if needed
- Other environment-specific variables

### 4. Database Setup
```bash
# Run migrations and seed the database
php artisan migrate --seed
```

### 5. Cache & Optimization
```bash
# Clear all caches
php artisan optimize:clear

# Optimize the application
php artisan optimize
```

### 6. Start the Application

#### Option 1: Laravel Development Server
```bash
php artisan serve
```

#### Option 2: Laravel Herd (Recommended for Mac/Windows users)
If you're using [Laravel Herd](https://herd.laravel.com/), you don't need to run `php artisan serve`. Herd automatically serves your Laravel applications. Just ensure your project is in Herd's parked directory.

#### Option 3: With Queue Worker (Recommended for full functionality)
```bash
# If you're using Herd, you can skip Terminal 1 where you would normally run php artisan serve
# Terminal 1: Start the web server (skip if using Herd)
php artisan serve

# Terminal 2: Start the queue worker
php artisan queue:work redis

# Terminal 3: Start the scheduler (if using scheduled tasks)
php artisan schedule:work
```

The application will be available at:
- `http://localhost:8000` (if using `php artisan serve`)
- `http://your-project-name.test` (if using Laravel Herd)

## 📁 Project Structure

```
├── app/                    # Application core files
│   ├── Console/           # Artisan commands
│   ├── Enums/             # Application enumerations
│   ├── Exceptions/        # Exception handlers
│   ├── Http/              # HTTP layer (Controllers, Middleware, Requests)
│   ├── Jobs/              # Queue jobs
│   ├── Models/            # Eloquent models
│   ├── Policies/          # Authorization policies
│   ├── Providers/         # Service providers
│   ├── Services/          # Business logic services
│   └── Traits/            # Reusable traits
├── config/                # Configuration files
├── database/              # Database files
│   ├── factories/         # Model factories
│   ├── migrations/        # Database migrations
│   └── seeders/           # Database seeders
├── routes/                # Route definitions
│   ├── api.php           # API routes
│   ├── auth.php          # Authentication routes
│   └── web.php           # Web routes
├── storage/               # Storage files
└── tests/                 # Test files (empty - tests not implemented yet)
```
