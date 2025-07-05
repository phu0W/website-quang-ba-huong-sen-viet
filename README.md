<h1 align="center">Huong Sen Viet - Course Promotion Website</h1>

<p align="center">
  A Laravel-based educational website built for course marketing, sample lesson showcasing, and student engagement. <br>
  Developed as a graduation project, implemented in a real-world education company context.
</p>


---

## About the Project

This project aims to build a modern and user-friendly web application that helps **Huong Sen Viet Education Company** promote their courses and connect with students online.


---

## Key Features

- Public website for showcasing:
  - Courses by subject
  - Sample lessons (free)
  - Huong Sen Viet's information
  - Contact & registration form
- Admin panel with CRUD management for:
  - Subjects
  - Courses
  - Accounts (admins/students)
  - Sample and paid lessons
  - News and announcements
  - Exams per course and student results
- Simple authentication for admin users
- Responsive UI (compatible with desktop and mobile)
- Data stored securely using MySQL

## Technologies Used

  - PHP 8.x
  - Laravel 10
  - MySQL
  - Bootstrap 5
  - CKEditor (for content editing)
  - Youtube API (for video storage)

---

## Installation

```bash
# Clone the repository
git clone https://github.com/phu0W/website-quang-ba-huong-sen-viet.git


# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Set up database credentials in .env

# Generate application key
php artisan key:generate

# Run database migrations
php artisan migrate

# (Optional) Seed some demo data
php artisan db:seed

# Run development server
php artisan serve