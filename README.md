# Laravel Webshop

A modern e-commerce web application built with Laravel 10, featuring a complete shopping cart system, user authentication, admin panel, and order management.

## Features

### Customer Features

- 🛍️ **Product Catalog** - Browse products with search, filtering by category, and price range
- 🛒 **Shopping Cart** - Add, update, and remove items with persistent cart storage
- 🔐 **User Authentication** - Register, login, and manage your profile
- 💳 **Checkout System** - Complete orders with multiple payment methods (Credit Card, PayPal, Bank Transfer)
- 📦 **Order History** - View all your past orders with detailed information
- 🔍 **Product Search** - Search products by name or description
- 📱 **Responsive Design** - Works seamlessly on desktop and mobile devices

### Admin Features

- 🎛️ **Admin Dashboard** - Manage products, categories, and orders
- ➕ **Product Management** - Create, edit, and delete products with image uploads
- 🏷️ **Category Management** - Organize products into categories
- 📊 **Stock Management** - Track product inventory
- 🔒 **Role-Based Access** - Admin-only areas with middleware protection

### Technical Features

- 🗄️ **Database Migrations & Seeders** - Easy database setup
- 🎨 **Tailwind CSS** - Modern, responsive UI design
- 🔄 **Service Pattern** - CartService for business logic separation
- ✅ **Type Safety** - PHP 8.2+ with return type declarations
- 🔗 **Eloquent ORM** - Efficient database operations with relationships
- 🌐 **RESTful API** - API endpoints for products, orders, and categories

## Tech Stack

- **Backend**: Laravel 10.x
- **Frontend**: Blade Templates, Tailwind CSS, Alpine.js
- **Database**: MySQL
- **Authentication**: Laravel Breeze
- **Build Tool**: Vite

## Installation

### Prerequisites

- PHP 8.2 or higher
- Composer
- MySQL 8.0 or higher
- Node.js & NPM (for frontend assets)

### Setup Instructions

1. **Clone the repository**

   ```bash
   git clone <repository-url>
   cd Laravel-Webshop/webshop-app
   ```

2. **Install PHP dependencies**

   ```bash
   composer install
   ```

3. **Install Node dependencies**

   ```bash
   npm install
   ```

4. **Environment setup**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database configuration**

   Update your `.env` file with your database credentials:

   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=laravel_webshop
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run migrations and seed database**

   ```bash
   php artisan migrate
   php artisan db:seed
   ```

7. **Create storage link**

   ```bash
   php artisan storage:link
   ```

8. **Build frontend assets**

   ```bash
   npm run dev
   ```

9. **Start the development server**

   ```bash
   php artisan serve
   ```

10. **Access the application**

    Open your browser and go to: `http://localhost:8000`

## Default Credentials

After seeding, you can use these credentials:

**Admin Account:**

- Email: `admin@example.com`
- Password: `password`

**Customer Account:**

- Email: `user@example.com`
- Password: `password`

## Project Structure

```
webshop-app/
├── app/
│   ├── Http/Controllers/      # Application controllers
│   │   ├── Admin/            # Admin-specific controllers
│   │   ├── Api/              # API controllers
│   │   └── Auth/             # Authentication controllers
│   ├── Models/               # Eloquent models
│   ├── Services/             # Business logic services
│   └── View/Components/      # Blade components
├── database/
│   ├── migrations/           # Database migrations
│   └── seeders/             # Database seeders
├── resources/
│   ├── views/               # Blade templates
│   ├── css/                 # Stylesheets
│   └── js/                  # JavaScript files
└── routes/
    ├── web.php              # Web routes
    ├── api.php              # API routes
    └── auth.php             # Authentication routes
```

## Available Commands

```bash
# Run tests
php artisan test

# Clear application cache
php artisan cache:clear

# Clear config cache
php artisan config:clear

# Optimize for production
php artisan optimize

# Run database migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback

# Seed database
php artisan db:seed
```

## API Endpoints

The application includes RESTful API endpoints:

- `GET /api/products` - List all products
- `GET /api/products/{id}` - Get single product
- `GET /api/categories` - List all categories
- `GET /api/orders` - List user orders (authenticated)
