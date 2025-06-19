# Frontend - Documentation

A modern, responsive frontend application built with **Nuxt 3**, and **Quasar UI** for managing blood donation operations. This application provides an intuitive interface for donors, administrators, and staff to manage blood donation activities efficiently.

## 🚀 Quick Start

### Prerequisites

- Node.js (v18 or higher)
- pnpm package manager

### 1. Install Dependencies

```bash
pnpm install
```

This will install all required dependencies including Nuxt 3, Vue 3, Quasar UI, Pinia, and other essential packages.

### 2. Environment Configuration

Copy the environment example file and configure your environment variables:

```bash
cp .env.example .env
```

**Environment Variables:**

- `VITE_API_BASE_URL`: Backend API base URL (e.g., `http://blood-donation-rev-backend.test/api`)
- `VITE_SITE_URL`: Frontend application URL (e.g., `http://localhost:3000`)
- `VITE_APP_NAME`: Application name displayed in UI
- `VITE_APP_VERSION`: Application version
- `VITE_APP_DESCRIPTION`: Brief description of the application
- `VITE_APP_AUTHOR`: Application author

> **Important:** The `.env` file is crucial for connecting the frontend to the backend API and configuring application metadata. Without proper environment variables, the application won't function correctly.

### 3. Run Development Server

```bash
pnpm run fire
```

This executes `pnpm run dev` to start the Nuxt development server at `http://localhost:3000`.

### 4. Development Tools

Ensure you have the following VS Code extensions for optimal development experience:

- **Prettier** - Code formatter
- **ESLint** - Code linting and quality checks
- **Volar** - Vue 3 language support
- **TypeScript Vue Plugin (Volar)** - Enhanced TypeScript support

## 📦 Key Packages & Technologies

### Core Framework

- **Nuxt 3** (`^3.17.5`) - Full-stack Vue framework with SSR/SSG capabilities
- **Vue 3** (`^3.5.16`) - Progressive JavaScript framework for building user interfaces

### UI Framework

- **Quasar UI** (`^2.18.1`) - Vue.js based framework with Material Design components
- **nuxt-quasar-ui** (`2.1.12`) - Nuxt module for seamless Quasar integration
- **@quasar/extras** (`^1.17.0`) - Additional Quasar resources (fonts, icons)

### State Management

- **Pinia** (`^3.0.3`) - Vue's official state management library
- **@pinia/nuxt** (`^0.11.1`) - Nuxt integration for Pinia
- **pinia-plugin-persistedstate** (`^4.3.0`) - Persist Pinia state across browser sessions

### HTTP Client & Security

- **Axios** (`^1.9.0`) - Promise-based HTTP client for API communications
- **secure-ls** (`^2.0.0`) - Secure local storage with encryption

### Development Tools

- **@nuxt/eslint** (`1.4.1`) - ESLint configuration for Nuxt projects
- **TypeScript** - Type-safe JavaScript development

## 📁 Project Structure

### `/components`

Reusable Vue components organized by feature:

- `LoadingState.vue` - Global loading component
- `Donor/` - Donor-specific components

### `/composables`

Vue 3 composition functions for shared logic:

- `useHttpClient.ts` - HTTP client management
- `useLocalAsyncData.ts` - Local data caching utilities

### `/layouts`

Application layout templates:

- `default.vue` - Main application layout with navigation and user management

### `/middleware`

Route protection and navigation guards:

- `auth.global.ts` - Global authentication middleware
- `guest.ts` - Guest-only route protection

### `/pages`

File-based routing structure:

- `index.vue` - Home page
- `admin/` - Administrative pages
- `auth/` - Authentication pages
- `blood-group/` - Blood group management
- `donor/` - Donor management pages

### `/plugins`

Nuxt plugins for extending functionality

### `/public`

Static assets:

- `assets/` - Images, icons, and other static resources
- `favicon.ico` - Site favicon
- `robots.txt` - SEO robots configuration

### `/server`

Server-side API routes and middleware

### `/services`

API service layers for backend communication:

- `admin-service.ts` - Administrative operations
- `auth-service.ts` - Authentication services
- `donor-service.ts` - Donor management services

### `/stores`

Pinia state management stores:

- `admin-store.ts` - Administrative state
- `auth-store.ts` - Authentication state
- `donor-store.ts` - Donor management state

### `/types`

TypeScript type definitions:

- `bloodGroup.ts` - Blood group related types
- `dashboard.ts` - Dashboard data types
- `query.ts` - API query types
- `user.ts` - User and authentication types

### `/utils`

Utility functions and helpers:

- `blood-group.ts` - Blood group utilities
- `helpers.ts` - General helper functions
- `http-client.ts` - HTTP client configuration
- `meta.ts` - Meta tag utilities
- `profile-links.ts` - User profile navigation
- `roles.ts` - Role management utilities

## 🎨 Default Layout

The `layouts/default.vue` serves as the main application shell:

**Key Features:**

- **Navigation Header**: Contains the application logo, title, and user menu
- **Responsive Design**: Adapts to different screen sizes using Quasar's layout system
- **User Authentication UI**: Displays user avatar and profile menu when authenticated
- **Role-based Navigation**: Shows different menu options based on user roles
- **Logout Functionality**: Integrated logout mechanism

**Layout Structure:**

```vue
<q-layout view="Hhh lpr Fff">
  <q-header> <!-- Navigation bar --> </q-header>
  <q-page-container> <!-- Main content area --> </q-page-container>
</q-layout>
```

The layout automatically wraps all pages and provides consistent navigation and user experience across the application.

## 🛡️ Middleware System

### `auth.global.ts` - Global Authentication Guard

- **Purpose**: Protects routes that require authentication
- **Functionality**:
  - Checks if user is authenticated for protected routes
  - Validates user roles against required permissions
  - Redirects unauthorized users to login page
  - Redirects users to appropriate dashboards based on roles

### `guest.ts` - Guest Route Protection

- **Purpose**: Restricts authenticated users from accessing guest-only pages
- **Functionality**:
  - Prevents logged-in users from accessing login/register pages
  - Redirects authenticated users to the home page
  - Ensures proper navigation flow for different user states

## 🔧 Services Layer

The services layer abstracts API communications and provides a clean interface for data operations:

**Why Services are Used:**

- **Separation of Concerns**: Keeps API logic separate from components
- **Reusability**: Services can be used across multiple components
- **Maintainability**: Centralized API endpoint management
- **Type Safety**: Provides typed interfaces for API responses
- **Error Handling**: Consistent error handling across the application

Each service corresponds to a specific domain (auth, admin, donor) and encapsulates related API operations.

## 🗄️ State Management (Stores)

Pinia stores manage application state with the following benefits:

**Why Stores are Necessary:**

- **Centralized State**: Single source of truth for application data
- **Reactivity**: Automatic UI updates when state changes
- **Persistence**: State persists across browser sessions using `pinia-plugin-persistedstate`
- **Type Safety**: Full TypeScript support with auto-completion
- **DevTools**: Excellent debugging experience with Vue DevTools

Each store manages domain-specific state and provides actions for state mutations.

## 📝 Types System

The `/types` directory contains TypeScript definitions for:

**Purpose and Contents:**

- **bloodGroup.ts**: Blood group enums and related interfaces
- **dashboard.ts**: Dashboard statistics and data structures
- **query.ts**: API query parameters and filters
- **user.ts**: User authentication and profile interfaces

**Why Types are Necessary:**

- **Type Safety**: Prevents runtime errors through compile-time checking
- **Developer Experience**: Auto-completion and IntelliSense support
- **Documentation**: Types serve as living documentation
- **Refactoring**: Safe code refactoring with confidence

## 🛠️ Utilities

The `/utils` directory contains helper functions used throughout the application:

**Key Utilities:**

- **blood-group.ts**: Blood group formatting and validation
- **helpers.ts**: General purpose functions (email validation, query string building)
- **http-client.ts**: Axios configuration with interceptors and error handling
- **meta.ts**: SEO and meta tag management
- **profile-links.ts**: User navigation menu configuration
- **roles.ts**: Role-based access control utilities

**Usage Throughout the App:**

- Components import utilities for data formatting and validation
- Services use HTTP client for API communications
- Middleware leverages role utilities for access control
- Pages use meta utilities for SEO optimization

## 📄 App.vue - Application Root

The `app.vue` file serves as the application's root component:

**Structure and Purpose:**

```vue
<template>
	<div>
		<NuxtRouteAnnouncer />
		<!-- Accessibility announcements -->
		<NuxtLayout>
			<!-- Layout wrapper -->
			<NuxtPage />
			<!-- Dynamic page content -->
		</NuxtLayout>
	</div>
</template>
```

**Key Features:**

- **Route Announcer**: Provides accessibility support for screen readers
- **Layout System**: Wraps pages with the appropriate layout
- **Page Rendering**: Dynamically renders the current page component
- **Minimal Structure**: Keeps the root component clean and focused

## ⚙️ Nuxt Configuration

The `nuxt.config.ts` file configures the entire Nuxt application:

### Quasar UI Configuration

```typescript
quasar: {
  plugins: ['Dialog', 'Loading', 'LoadingBar', 'Notify', 'Dark'],
  extras: { font: 'roboto-font' },
  config: { /* Notification settings */ }
}
```

**Why Quasar Config is Needed:**

- Enables specific Quasar plugins (dialogs, notifications, loading states)
- Configures Material Design theme and typography
- Sets up global notification behavior and styling

### Auto-imports Configuration

```typescript
imports: {
	dirs: ['composables', 'utils', 'types', 'services']
}
```

**Why Import Dirs are Defined:**

- **Developer Experience**: No need for manual imports in components
- **Code Cleanliness**: Reduces boilerplate import statements
- **Type Safety**: Maintains TypeScript support for auto-imported functions
- **Performance**: Tree-shaking ensures only used code is bundled

### Pinia Configuration

```typescript
pinia: {
	storesDirs: ['stores/**']
}
```

**Why Pinia Config is Necessary:**

- **Auto-discovery**: Automatically registers all store files
- **Hot Reload**: Enables store hot-reloading during development
- **TypeScript Integration**: Provides proper type inference for stores

## 🚀 Development Scripts

- `pnpm run dev` - Start development server
- `pnpm run fire` - Alias for dev server (custom command)
- `pnpm run build` - Build for production
- `pnpm run preview` - Preview production build
- `pnpm run generate` - Generate static site

## 🏗️ Build and Deployment

The application is built using Nuxt's universal rendering capabilities, supporting both SSR and static generation for optimal performance and SEO.
