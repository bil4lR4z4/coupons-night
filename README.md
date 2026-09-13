Coupon Night

A multi-vendor Laravel-based coupon, deals, and product marketplace system where multiple users can add stores, categories, coupons, deals, and products. All content is reviewed and approved by a super admin before being published.

Project Overview

Coupon Night is a centralized platform where multiple users (vendors/admins) can manage their own stores, categories, coupons, deals, and products. A super admin reviews and approves all submitted content before it goes live. Users can click on products and be redirected to the original external website for purchase. Every user activity is tracked for monitoring and analytics purposes.

Key Features
Multi User System
Multiple admins and users
Role-based access control
Each user manages their own data
Store and Category Management
Create and manage stores
Organize content using categories
Coupons and Deals System
Add discount coupons
Manage promotional deals
Approval-based publishing system
Product Listings
Add products with external purchase links
Redirect users to original websites for purchase
Super Admin Approval System
All content requires approval before publishing
Ensures quality control over all data
Activity Tracking
Track user actions such as add, edit, delete, and login activities
Admin monitoring system for transparency
Tech Stack
Laravel Framework
PHP
MySQL
Bootstrap
HTML
CSS
JavaScript
jQuery
Installation

Clone the repository and navigate into the project directory:

git clone https://github.com/your-username/coupon-night.git
cd coupon-night

Install project dependencies using Composer (this will also generate the vendor folder):

composer install

Create the environment file:

cp .env.example .env

Configure your database credentials inside the .env file.

Generate the application key:

php artisan key:generate

Run database migrations:

php artisan migrate

Seed the database with default data (including admin account):

php artisan db:seed

Start the development server:

php artisan serve
Default Admin Credentials

Email: admin@example.com
Password: 12345678
