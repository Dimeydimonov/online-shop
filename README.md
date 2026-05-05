E Commerce Online Shop Platform

A full featured e commerce platform built with Laravel 11, featuring comprehensive product management, shopping cart
functionality, order processing, and admin dashboard. Includes social authentication via Socialite and SMS notifications
through Twilio integration.

[PHP](https://img.shields.io/badge/PHP 8.2 777BB4?style=flat square&logo=php)
[Laravel](https://img.shields.io/badge/Laravel 11.31 FF2D20?style=flat square&logo=laravel)
[Docker](https://img.shields.io/badge/Docker Compose 2496ED?style=flat square&logo=docker)
[Socialite](https://img.shields.io/badge/Laravel Socialite FB503B?style=flat square)
[Twilio](https://img.shields.io/badge/Twilio SMS F22F46?style=flat square&logo=twilio)

Features

Customer Features

Product Browsing Browse products with search and filtering
Shopping Cart Add/remove products, manage quantities
User Authentication Register/login with email or social providers
Social Login Google, Facebook, Instagram integration via Laravel Socialite
Order Management Place orders and track order history
User Profile Manage personal information and preferences
Password Reset SMS based password reset via Twilio

Admin Features

Admin Dashboard Comprehensive admin interface
Product Management CRUD operations for products
User Management Manage customer accounts and permissions
Order Management View and process customer orders
Discount System Set and manage product discounts
Reports & Analytics Sales reports and platform statistics
Product Status Control Enable/disable products

Technical Features

Service Layer Architecture Clean separation of business logic
Repository Pattern Data access abstraction
Docker Deployment Containerized application setup
Queue System Background job processing
Session based Cart Persistent shopping cart across sessions

Tech Stack

Backend: PHP 8.2, Laravel 11
Database: MySQL/PostgreSQL with migrations
Frontend: Laravel UI with Bootstrap/Tailwind
Authentication: Laravel Socialite (Google, Facebook, Instagram)
Notifications: Twilio SDK for SMS
Infrastructure: Docker Compose
Task Queues: Laravel Queue workers
Development Tools: Laravel Pint, Pail, Sail

Architecture

The application follows Laravel's service layer pattern with clear separation of concerns:

Routes → Controllers → Services → Repositories → Models

Service Classes (11 Total)

1. UserService User account management
2. ProductService Product catalog operations
3. CartService Shopping cart functionality
4. OrderService Order processing and management
5. CheckoutService Checkout flow handling
6. PaymentService Payment processing logic
7. NotificationService SMS and email notifications
8. ReportService Analytics and reporting
9. DiscountService Promotion and discount management
10. SearchService Product search functionality
11. AuthService Authentication and social login
    Quick Start

Prerequisites

Docker and Docker Compose
Git

Installation
Clone the repository

bash
git clone <repository url>
cd online shop
Environment setup

bash
cp .env.example .env
Configure database, Twilio, and social login credentials in .env

Start with Docker

bash
docker compose up d
Install dependencies

bash
docker compose exec php fpm composer install
docker compose exec php fpm npm install
docker compose exec php fpm npm run build

Initialize database

bash
docker compose exec php fpm php artisan key:generate
docker compose exec php fpm php artisan migrate:fresh seed
Access the application

Shop: http://localhost
Admin Dashboard: http://localhost/dashboard

Development Mode

Run all services in development mode:

bash
composer dev

This starts:

PHP development server
Queue worker
Log monitoring (Pail)
Vite dev server

Social Authentication Setup

Configure social providers in `.env`:

env
Google OAuth
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URL="${APP_URL}/login/google/callback"

Facebook OAuth
FACEBOOK_CLIENT_ID=your_facebook_app_id
FACEBOOK_CLIENT_SECRET=your_facebook_app_secret
FACEBOOK_REDIRECT_URL="${APP_URL}/login/facebook/callback"

Instagram OAuth
INSTAGRAM_CLIENT_ID=your_instagram_client_id
INSTAGRAM_CLIENT_SECRET=your_instagram_client_secret
INSTAGRAM_REDIRECT_URL="${APP_URL}/login/instagram/callback"

Twilio SMS Configuration

Configure Twilio for SMS notifications in `.env`:

env
TWILIO_SID=your_twilio_account_sid
TWILIO_TOKEN=your_twilio_auth_token
TWILIO_FROM=your_twilio_phone_number

Core Functionality

Shopping Cart

Session based cart persistence
Add/remove/update product quantities
Calculate totals with discounts
Guest and authenticated user support

Order Management

Order placement with validation
Order status tracking
Order history for customers
Admin order management interface

Product System

Product CRUD operations
Image upload and management
Category based organization
Discount and pricing management
Stock tracking
Active/inactive status control

User System

Email based registration
Social login integration
Profile management
Role based permissions (admin/customer)
Password reset via SMS

Admin Dashboard

Access: `/dashboard` (admin role required)

Features

Dashboard Overview Key metrics and statistics
User Management View/edit/delete customer accounts
Product Management Complete product CRUD interface
Order Processing View and manage customer orders
Reports Sales analytics and platform metrics
Settings System configuration options

Admin Controls

Toggle product active/inactive status
Set/remove product discounts
Manage user roles and permissions
View detailed order information
Generate sales reports

Project Structure

app/
Http/
Controllers/
─ Admin/ Admin panel controllers
── ProductController.php
─ Auth/ Authentication controllers
─ LoginController.php
── RegisterController.php
── SocialAuthController.php
── ResetPasswordController.php
─ CartController.php Shopping cart
─ ProductController.php Product catalog
─ OrderController.php Order management
─ ProfileController.php User profiles
── Middleware/ Custom middleware
Models/ Eloquent models
── User.php
── Product.php
── Order.php
── OrderItem.php
Services/ Business logic layer (11 services)
── UserService.php
── ProductService.php
── CartService.php
── OrderService.php
── CheckoutService.php

─ Repositories/ Data access layer
─ Providers/ Service providers

database/
─ migrations/ Database schema
─ seeders/ Sample data
─ factories/ Model factories

resources/

─ views/ Blade templates
── admin/ Admin interface
── auth/ Authentication views
── cart/ Cart views
── products/ Product views
─ js/ Frontend assets
─ css/ Styling

Security Features

CSRF Protection Built in Laravel CSRF protection
SQL Injection Prevention Eloquent ORM with prepared statements
Authentication Laravel's built in auth system
Authorization Role based access control
Input Validation Form request validation
Social Login Security OAuth 2.0 via Laravel Socialite
Password Security Bcrypt hashing
Session Security Secure session configuration

Development Commands
bash
Run development environment with hot reloading
composer dev

Code formatting
php artisan pint

Run tests
php artisan test

Clear caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear

Queue management
php artisan queue:work
php artisan queue:restart

Database operations
php artisan migrate
php artisan migrate:fresh seed
php artisan db:seed

API Endpoints

Public Endpoints

`GET /`   Product listing
`GET /products/{id}`   Product details
`GET /search/suggestions`   Search autocomplete

Authenticated Endpoints

`GET /cart`   View shopping cart
`POST /cart/add`   Add item to cart
`GET /profile`   User profile
`GET /user/orders`   Order history

Admin Endpoints (Admin role required)

`GET /dashboard`   Admin dashboard
`GET /admin/products`   Product management
`GET /admin/users`   User management
`GET /admin/orders`   Order management
`GET /reports`   Analytics and reports

Future Enhancements

E commerce Features

Payment Gateway Integration Stripe, PayPal, etc.
Inventory Management Stock tracking and alerts
Wishlist System Save products for later
Product Reviews Customer feedback system
Shipping Integration Real time shipping calculations
Coupon System Advanced discount codes

Technical Improvements

API Development RESTful API with authentication
Real time Features WebSocket integration
Search Enhancement Elasticsearch integration
Performance Redis caching, database optimization
Testing Comprehensive test suite
Mobile App React Native/Flutter companion

Advanced Features

Multi vendor Support Marketplace functionality
Subscription Products Recurring payments
Advanced Analytics Customer behavior tracking
Marketing Tools Email campaigns, promotions
International Multi currency, multi language

Testing

Run the test suite:

bash
php artisan test

Test Coverage

Unit tests for services and models
Feature tests for controllers and routes
Integration tests for complete workflows
Database tests with factories and seeders

Contributing

1. Fork the repository
2. Create a feature branch (`git checkout  b feature/amazing feature`)
3. Commit changes (`git commit  m 'Add amazing feature'`)
4. Push to branch (`git push origin feature/amazing feature`)
5. Open a Pull Request

Development Guidelines

Follow PSR 12 coding standards
Write tests for new features
Update documentation
Use semantic commit messages
Follow Laravel best practices

License

This project is open sourced software licensed under the [MIT license]().

Built with using Laravel 11 and modern e commerce practices