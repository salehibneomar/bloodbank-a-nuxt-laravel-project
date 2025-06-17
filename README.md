# 🩸BloodBank App: A FullStack Nuxt-Laravel Project

BloodBank App is designed to efficiently manage blood donors and their donation records. The system automatically tracks donor eligibility based on their last donation date and provides a seamless experience for both administrators and donors through its intuitive web interface. The application utilizes cache server to cache repetitive and data that will not be updated frequently but will be frequently fetched, ensuring optimal performance and faster response times.

## 🚀 Technology Stack

### Backend (Laravel 12)

- **Framework**: Laravel 12 with PHP 8.4
- **Database**: MySQL 8.0 for primary data storage
- **Cache & Queue**: Redis for caching and queue management
- **Authentication**: Laravel Sanctum for API authentication
- **Authorization**: Role-based access control system
- **Architecture**: Service pattern for clean code organization
- **Background Jobs**: Queued jobs for enhanced user experience
- **Automation**: Scheduler runs daily at 6 AM to update donor availability
- **API**: Generalized API responses for consistent HTTP operations
- **Performance**: Database indexing and views for query optimization

### Frontend (Nuxt 3)

- **Framework**: Nuxt 3 Meta framework of Vue.js
- **Rendering**: SSR (Server-Side Rendering) for improved performance and SEO
- **Language**: TypeScript for type safety
- **State Management**: Pinia stores for reactive state management
- **HTTP Client**: Centralized singleton Axios client for API calls
- **UI Framework**: Quasar UI module for modern, intuitive interface
- **Routing**: Protected routes with custom middleware

## ✨ Key Features

- **Multi-role Authentication System**: Secure access control for different user types
- **Automated Donor Management**: Daily scheduler checks donation eligibility
- **Performance Optimized**: Database views and indexing for large datasets
- **Modern Development Practices**: Clean architecture with service patterns
- **Responsive UI**: Mobile-friendly interface with Quasar components
- **Type Safety**: Full TypeScript implementation on frontend
- **Background Processing**: Queued jobs for smooth user experience
- **Server-Side Rendering**: Enhanced performance and SEO with SSR

## 🛠️ Development Approach

This project embraces modern development methodologies:

- **AI-Assisted Development**: Leveraging AI agents for code generation and review
- **Git Flow**: Structured branching strategy for organized development
- **Code Review**: Manual code review process for AI-generated code to ensure quality assurance
- **Clean Architecture**: Separation of concerns with service-controller pattern
- **Singleton Pattern**: Centralized HTTP client implementation for consistent API communication
- **Testing & Debugging**: Postman for API testing and Laravel Telescope for application debugging

## 🚦 Getting Started

### Prerequisites

- PHP 8.2+
- Node.js 18+
- MySQL 8.0+
- Redis (must be installed and running locally)
- Composer
- PNPM

> **Note**: Make sure Redis is installed and running on your local machine before starting the backend server, as it's required for caching and queue management.

> **Important**: For both frontend and backend setups, after copying `.env.example` to `.env`, make sure to configure your local environment credentials including database connection, Redis settings, backend API endpoint (e.g., `http://localhost:8000`), and any other required environment variables. Please follow the example .env files.

### Backend Setup

```bash
cd backend
composer install
cp .env.example .env
# Edit .env file with your local database, Redis, and other service credentials
php artisan key:generate
php artisan migrate --seed
php artisan optimize
php artisan serve
```

**Additional Commands:**

- `php artisan schedule:work` - Run the scheduler
- `php artisan queue:work redis` - Process queued jobs

### Frontend Setup

```bash
cd frontend
cp .env.example .env
# Edit .env file with your backend API endpoint and other local environment settings
pnpm install
pnpm run fire
```
