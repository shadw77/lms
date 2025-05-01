# Laravel Learning Managment System

A Laravel-based web application for managing courses, lessons, and student enrollments.

---

## 🚀 Environment Setup

1. **Clone the repository**
   ```bash
   git clone git@github.com:shadw77/lms.git
   cd lms

## 🚀 Run The Project

2. **Install dependencies**
   ```bash
   composer install
   npm install && npm run dev
4. **Create and configure .env file**
   ```bash
   cp .env.example .env
   php artisan key:generate
   php artisan ser
6. **Run migrations and seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
8. **Run test cases**
   ```bash
   php artisan test tests/Feature/CourseTest.php
   php artisan test tests/Feature/EnrollmentTest.php
