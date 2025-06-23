# 🩸 BloodBank Backend API

A robust Laravel-based REST API for managing blood donors, donations, and administrative operations in the BloodBank application.

## 🚀 Technology Stack

-   **Framework**: Laravel 12 with PHP 8.2+
-   **Database**: MySQL 8.0
-   **Cache & Queue**: Redis
-   **Authentication**: Laravel Sanctum
-   **Testing**: PHPUnit
-   **Code Quality**: Laravel Pint
-   **Monitoring**: Laravel Telescope
-   **Frontend Assets**: Vite with TailwindCSS

## 📋 Requirements

-   PHP 8.2 or higher
-   Composer
-   MySQL 8.0+
-   Redis server
-   Node.js & npm (for frontend assets)

## 🛠️ Installation

1. **Clone the repository**

    ```bash
    git clone <repository-url>
    cd backend
    ```

2. **Install PHP dependencies**

    ```bash
    composer install
    ```

3. **Install Node.js dependencies**

    ```bash
    npm install
    ```

4. **Environment setup**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5. **Configure your `.env` file**

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=bloodbank
    DB_USERNAME=your_username
    DB_PASSWORD=your_password

    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379

    CACHE_STORE=redis
    QUEUE_CONNECTION=redis
    SESSION_DRIVER=redis
    ```

6. **Run database migrations**

    ```bash
    php artisan migrate
    ```

7. **Seed the database (optional)**

    ```bash
    php artisan db:seed
    ```

8. **Start the development server**
    ```bash
    composer run dev
    ```

## 🏗️ Project Structure

```
backend/
├── app/
│   ├── Console/Commands/        # Artisan commands
│   ├── Enums/                  # Enum classes
│   ├── Http/
│   │   ├── Controllers/        # API controllers
│   │   ├── Middleware/         # Custom middleware
│   │   └── Requests/           # Form requests
│   ├── Models/                 # Eloquent models
│   ├── Policies/               # Authorization policies
│   ├── Providers/              # Service providers
│   ├── Services/               # Business logic services
│   └── Traits/                 # Reusable traits
├── config/                     # Configuration files
├── database/
│   ├── factories/              # Model factories
│   ├── migrations/             # Database migrations
│   └── seeders/                # Database seeders
├── routes/
│   ├── api.php                 # API routes
│   ├── auth.php                # Authentication routes
│   └── web.php                 # Web routes
├── storage/                    # File storage
└── tests/                      # Test files
```

## 🔐 Authentication

The API uses Laravel Sanctum for authentication. Users can authenticate via:

-   **Login**: `POST /api/login`
-   **Register**: `POST /api/register`
-   **Logout**: `POST /api/logout`

### Token Usage

Include the token in your requests:

```bash
Authorization: Bearer {your-token}
```

## 📚 API Endpoints

### Authentication

-   `POST /api/login` - User login
-   `POST /api/register` - User registration
-   `POST /api/logout` - User logout

### Admin Operations

-   `GET /api/admin/dashboard` - Admin dashboard data
-   `GET /api/donors/admin/manage` - Manage donors
-   `PUT /api/donors/change-status/{id}` - Change donor status

### Donor Operations

-   `GET /api/donors/` - List all donors
-   `GET /api/donors/{id}/information` - Get donor information
-   `GET /api/donors/profile` - Get user profile (authenticated)
-   `PUT /api/donors/profile` - Update user profile (authenticated)

### Meta Information

-   `GET /api/meta/information` - Get application meta information

## 👥 User Roles

The system supports two user roles:

1. **Admin**: Full access to manage donors and view analytics
2. **Donor**: Can view and update their own profile

## 🗄️ Database Models

### User Model

-   Manages user authentication and basic information
-   Supports soft deletes
-   Roles: `admin`, `donor`

### DonorInformation Model

-   Stores detailed donor information
-   Tracks donation history and eligibility

## 🎯 Key Features

-   **Role-based Access Control**: Separate permissions for admins and donors
-   **Donor Management**: Track donor information and donation history
-   **Dashboard Analytics**: Administrative insights and statistics
-   **Profile Management**: Users can update their own information
-   **Soft Deletes**: Safe data removal with recovery options
-   **API Rate Limiting**: Protection against abuse
-   **Caching**: Redis-based caching for improved performance

## 🧪 Testing

Run the test suite:

```bash
composer test
# or
php artisan test
```

## 🔧 Development

### Code Style

The project uses Laravel Pint for code formatting:

```bash
vendor/bin/pint
```

### Queue Processing

Start the queue worker:

```bash
php artisan queue:work
```

### Monitoring

Laravel Telescope is available for debugging:

```bash
php artisan telescope:install
```

### Development Server

For development with hot reloading:

```bash
composer run dev
```

This command concurrently runs:

-   Laravel development server
-   Queue listener
-   Log monitoring (Pail)
-   Vite development server

## 📊 Performance

-   **Caching**: Redis-based caching for frequently accessed data
-   **Database Optimization**: Indexed queries and optimized relationships
-   **Queue Jobs**: Asynchronous processing for heavy operations
-   **API Rate Limiting**: Prevents abuse and ensures fair usage

## 🔒 Security

-   **Authentication**: Laravel Sanctum for API authentication
-   **Authorization**: Role-based access control
-   **Validation**: Form request validation for all inputs
-   **CORS**: Configured cross-origin resource sharing
-   **Rate Limiting**: API endpoint protection

## 🚀 Deployment

1. **Optimize for production**

    ```bash
    composer install --optimize-autoloader --no-dev
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    ```

2. **Set up supervisor for queues**

    ```ini
    [program:bloodbank-worker]
    process_name=%(program_name)s_%(process_num)02d
    command=php /path/to/artisan queue:work redis --sleep=3 --tries=3
    autostart=true
    autorestart=true
    user=www-data
    numprocs=8
    redirect_stderr=true
    stdout_logfile=/path/to/worker.log
    ```

3. **Configure web server** (Nginx example)

    ```nginx
    server {
        listen 80;
        server_name your-domain.com;
        root /path/to/public;

        location / {
            try_files $uri $uri/ /index.php?$query_string;
        }

        location ~ \.php$ {
            fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
            fastcgi_index index.php;
            fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
            include fastcgi_params;
        }
    }
    ```

## 📝 Environment Variables

Key environment variables:

```env
APP_NAME=BloodBank
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bloodbank
DB_USERNAME=your_username
DB_PASSWORD=your_password

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

CACHE_STORE=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

SANCTUM_STATEFUL_DOMAINS=your-frontend-domain.com
```
