# E-Catalog Instalation Guide
This guide will walk you through the steps to install the application.
## Prerequisities
Before you begin, make sure you have the following software installed:
- Git
- Composer
## Instalation Steps
### 1. Clone repository:
```bash
git clone https://github.com/bay195/e-catalog.git
cd e-catalog
```
### 2. Install dependency Laravel & Vite:
```bash
composer install
npm install
npm run dev
```
### 3. Generate the .env file and application key:
```bash
cp .env.example .env
php artisan key:generate
```
### 4. Database Config:
- Create new database named e-catalog
- Config the .env file
  ```env
  DB_DATABASE=e_catalog
  DB_USERNAME=root
  DB_PASSWORD=
  ```
### 5. Run:
```bash
php artisan migrate:fresh --seed
```
### 6. Run the web application:
```bash
php artisan serve
```

   
