# Laravel Multi-Translation Project

A Laravel-based API-driven service for managing translations in multiple locales (e.g., `en`, `fr`, `es`) with tagging and efficient data handling. The service is scalable, optimized for performance, and adheres to best practices like PSR-12, SOLID principles, and optimized SQL queries.

---

## Features

- Manage translations for multiple locales.
- Tag translations for context (e.g., `mobile`, `desktop`, `web`).
- Create, update, view, and search translations by tags, keys, or content.
- Export translations as JSON for frontend applications like Vue.js.
- Token-based authentication for securing the API.
- Dockerized for easier setup and deployment.
- CDN support for static assets.
- OpenAPI/Swagger documentation for the API.
- 95%+ test coverage with unit and feature tests.
- Optimized for high performance (<200ms for most endpoints, <500ms for JSON export of large datasets).

---

## Installation & Setup

### Prerequisites

Ensure the following are installed:

- **PHP >= 8.1**
- **Composer**
- **Docker & Docker Compose** (for containerized setup)

---

### Local Setup

1. **Clone the Repository**
   ```bash
   git clone https://github.com/khubaibkhan112/mutlitransaltionproject.git
   cd mutlitransaltionproject
2. **InstallInstall Dependencies**
    composer install
    php artisan key:generate
3. **Environment Configuration**
    cp .env.example .env
    Update the .env file with your database credentials:
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password

4. **Starting project**
    php artisan migrate --seed
    php artisan serve
    in browser go to http://127.0.0.1:8000.
5. **Docker Setup**
    docker-compose up -d
    docker exec -it <container_name> php artisan migrate --seed
6. **Running Tests**
    php artisan test

If you have any question mail me at khubaib.khan.code@gmail.com
Thank You


