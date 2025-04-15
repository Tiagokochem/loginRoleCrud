# 📦 Inventory Management System — Rede Parcerias

This project is a complete inventory management system, developed with **Laravel** (backend) and **React + Inertia.js** (frontend), using **JWT** authentication, role-based access control, and automated testing.

---
📄 [Versão em Português](./README.md)

## 🚀 Technologies Used

- Laravel 12 (REST API)
- React.js + Vite + Inertia.js
- TailwindCSS
- Laravel Breeze (auth + frontend)
- JWT Authentication (`tymon/jwt-auth`)
- MySQL
- Swagger (L5 Swagger)
- PHPUnit (with API and authentication tests)
- Docker + Laravel Sail

---

## 🔐 Access Levels

- **Administrator**: can create, edit, and delete products and categories.
- **Operator**: can view and update products.
- **Basic User**: can only view.

---

## 🧙 Test Users

| Name         | Email               | Password  | Role      |
|--------------|---------------------|-----------|-----------|
| Admin User   | admin@teste.com     | password  | admin     |
| Operator     | operador@teste.com  | password  | operador  |
| Basic User   | usuario@teste.com   | password  | usuario   |

## ✅ Features

- JWT Authentication
- Product CRUD with:
  - Name, description, quantity, price, SKU, category
- Filters by category, name, and price range
- Category creation and editing
- Versioned and protected API (`/api/v1/...`)
- Category caching
- Swagger API documentation
- Dashboard with total metrics
- Automated tests (login, product, category)

---

## 📂 Project Structure

- `/app/Http/Controllers/Api` — API Controllers
- `/resources/js/Pages` — React Pages with Inertia
- `/tests/Feature` — API and authentication tests
- `/database/seeders` — Example seeders (in development)

---

## 🧪 Run Tests

```bash
./vendor/bin/sail artisan migrate:fresh --env=testing
./vendor/bin/sail artisan test
```

---

## 🧾 API Documentation

After installing the project:

```bash
./vendor/bin/sail artisan l5-swagger:generate
```

Access it at: [http://localhost/api/documentation](http://localhost/api/documentation)

---

## 🐳 Run with Docker

```bash
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate --seed
```

---

## 🧙 Test Users

| Name     | Email               | Password  | Role     |
|----------|---------------------|-----------|----------|
| Admin    | admin@admin.com     | password  | admin    |
| Operator | operador@admin.com  | password  | operador |
| User     | user@admin.com      | password  | user     |

(Note: create via Seeder or manually in the database)

---

## How to Run Locally

# Clone the repository
git clone https://github.com/Tiagokochem/loginRoleCrud.git
cd loginRoleCrud

# Install dependencies via Composer with Sail
docker run --rm \
  -u "$(id -u):$(id -g)" \
  -v "$(pwd):/var/www/html" \
  -w /var/www/html \
  laravelsail/php83-composer:latest \
  composer install --ignore-platform-reqs

# Start the containers
./vendor/bin/sail up -d

# Run migrations (and seeders if desired)
./vendor/bin/sail artisan migrate --seed

![admin](https://github.com/user-attachments/assets/ac22f249-210e-492b-92fb-53202bd19df7)
![register](https://github.com/user-attachments/assets/b3df99fe-42c5-4a0b-b829-494fc462536a)
![category](https://github.com/user-attachments/assets/2e2f6d25-bfd6-43f2-adbc-843c09885674)
![doc](https://github.com/user-attachments/assets/c8f53800-24a0-444d-94f0-34f1022c73b9)

## 🧠 Author

Developed by **Tiago Kochem** [@tiagokochem](https://github.com/tiagokochem)