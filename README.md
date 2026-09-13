# Coupon Night

A **multi-vendor coupon, deals, and product marketplace platform** built with Laravel. The system allows multiple users to manage stores, categories, coupons, deals, and products, while a Super Admin reviews and approves submitted content before it is published.

---

## 📌 Project Overview

**Coupon Night** is a centralized marketplace platform developed for managing coupons, deals, stores, categories, and products.

The platform supports multiple users who can submit and manage their own content. A **Super Admin** reviews submitted content and can approve or reject it before it becomes publicly available.

Products can include external purchase links, allowing users to visit the original website to complete their purchase.

The system also includes **user activity tracking** to monitor important actions such as login, adding, editing, and deleting records.

---

## ✨ Key Features

### 👥 Multi-User System

* Multiple users and administrators
* Role-based access control
* User-specific data management
* Users can manage their own stores and content
* Centralized Super Admin management

### 🏪 Store Management

* Create and manage stores
* User-specific store management
* Store approval workflow
* Store status management
* Store details and information management

### 📂 Category Management

* Create and manage categories
* Organize stores, products, coupons, and deals
* Category-based content organization

### 🎟️ Coupons & Deals

* Add discount coupons
* Create promotional deals
* Manage coupon details
* Manage deal information
* Approval-based publishing
* Control published and pending content

### 🛍️ Product Management

* Add and manage products
* Product categorization
* Product details management
* Add external purchase URLs
* Redirect users to the original product website

### ✅ Super Admin Approval System

All submitted content can be reviewed by the Super Admin before publication.

The approval system provides:

* Content quality control
* Approval-based publishing
* Rejection of inappropriate content
* Centralized content management
* Better platform administration

### 📊 Activity Tracking

The system tracks important user activities for monitoring and administration.

Tracked activities include:

* User login
* Adding records
* Editing records
* Deleting records
* Other important system activities

This allows administrators to monitor user actions and maintain transparency across the platform.

### 📧 Email Notifications

The application includes email functionality for different system activities, including:

* Contact form notifications
* Coupon-related notifications
* Submitted offer notifications
* User notifications

### 🔐 Authentication & Authorization

* User authentication
* Admin authentication
* Role-based access control
* Protected admin areas
* User-specific permissions

### ⚙️ Admin Panel

The Super Admin can manage and monitor different areas of the platform, including:

* Users
* Stores
* Categories
* Coupons
* Deals
* Products
* Submitted offers
* FAQs
* Events
* Messages
* Website settings
* Theme settings
* Privacy and terms content
* Activity reports

---

## 🛠️ Tech Stack

| Technology     | Usage                   |
| -------------- | ----------------------- |
| **Laravel**    | Backend Framework       |
| **PHP**        | Server-Side Programming |
| **MySQL**      | Database                |
| **Bootstrap**  | UI Framework            |
| **HTML**       | Frontend Structure      |
| **CSS**        | Styling                 |
| **JavaScript** | Frontend Functionality  |
| **jQuery**     | Frontend Interactions   |

---

## 🚀 Installation

### 1. Clone the Repository

```bash
git clone https://github.com/bil4lR4z4/coupons-night.git
```

Navigate to the project directory:

```bash
cd coupons-night
```

### 2. Install Composer Dependencies

Install the required Laravel/PHP dependencies:

```bash
composer install
```

### 3. Create Environment File

Create the `.env` file from the example file:

```bash
cp .env.example .env
```

If you are using Windows and the above command does not work, you can manually copy `.env.example` and rename it to:

```text
.env
```

### 4. Configure Environment

Open the `.env` file and configure your application and database settings.

Example:

```env
APP_NAME="Coupon Night"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

Update the database values according to your local environment.

### 5. Generate Application Key

Run:

```bash
php artisan key:generate
```

### 6. Run Database Migrations

Create the required database tables:

```bash
php artisan migrate
```

### 7. Seed Default Data

Run the database seeder:

```bash
php artisan db:seed
```

This will insert the required default data, including the default administrator account if configured in the project seeders.

### 8. Start the Development Server

Run:

```bash
php artisan serve
```

The application will normally be available at:

```text
http://127.0.0.1:8000
```

---

## 🔐 Default Admin Credentials

After running the database seeders, the default administrator account can be accessed using:

```text
Email: admin@example.com
Password: 12345678
```

> **Security Note:** These credentials should be changed before deploying the application to a production environment.

---

## 🔄 Application Workflow

The general content workflow of the platform is:

```text
User
 │
 ├── Create Store
 ├── Add Category
 ├── Add Coupon
 ├── Add Deal
 └── Add Product
          │
          ▼
   Pending Approval
          │
          ▼
     Super Admin
          │
     ┌────┴─────┐
     ▼          ▼
 Approved     Rejected
     │
     ▼
Published Content
     │
     ▼
 Public Users
     │
     ▼
External Website
```

---

## 👨‍💼 Super Admin Responsibilities

The Super Admin has centralized control over the platform and can manage:

* Users
* Stores
* Categories
* Coupons
* Deals
* Products
* Submitted offers
* User activities
* Reports
* FAQs
* Events
* Messages
* Website settings
* Theme settings
* Privacy policy
* Terms of service

---

## 📁 Project Structure

```text
coupons-night/
│
├── app/
│   ├── Http/
│   ├── Models/
│   └── ...
│
├── bootstrap/
│
├── config/
│
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── factories/
│
├── public/
│
├── resources/
│   ├── views/
│   ├── css/
│   └── js/
│
├── routes/
│   ├── web.php
│   └── console.php
│
├── storage/
│
├── tests/
│
├── .env.example
├── artisan
├── composer.json
├── composer.lock
├── package.json
├── phpunit.xml
├── tailwind.config.js
└── vite.config.js
```

## 🔒 Security

For security reasons, environment-specific configuration should not be committed to the repository.

Make sure the following are properly configured before deploying the application:

* Strong database credentials
* Secure admin credentials
* `APP_KEY`
* `APP_ENV`
* `APP_DEBUG`
* `APP_URL`
* Mail configuration
* Production database configuration

The `.env` file should remain private and should not be uploaded to GitHub.

---

## ⚙️ Useful Laravel Commands

Clear application cache:

```bash
php artisan cache:clear
```

Clear configuration cache:

```bash
php artisan config:clear
```

Clear route cache:

```bash
php artisan route:clear
```

Clear compiled views:

```bash
php artisan view:clear
```

Clear all Laravel caches:

```bash
php artisan optimize:clear
```

---

## 📄 Project Information

**Coupon Night** was developed as a **client project** for a multi-vendor coupon, deals, and product marketplace platform.

The project was developed according to the client's business requirements and workflow, including vendor management, content approval, product listings, coupon and deal management, and administrative monitoring.

---

## 👨‍💻 Development

Developed using:

* Laravel
* PHP
* MySQL
* Bootstrap
* JavaScript
* jQuery

The application follows a role-based and approval-driven workflow to provide centralized management of platform content.

---

## 📌 Repository

GitHub Repository:

https://github.com/bil4lR4z4/coupons-night
