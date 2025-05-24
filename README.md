# Mini Medical E-Commerce System

This is a mini medical e-commerce platform built with Laravel + Blade + MySQL. It simulates a simplified admin and customer platform for managing and purchasing medical products.

---

## Features

### Customer Side (Public Area)

- View list of medical products with name, image, and price.
- Add products to cart.
- Manage cart items (update quantity, remove).
- Checkout without login (collect name, phone, delivery address).
- Order confirmation page with order summary.

### Admin Panel (Requires Login)

- Authentication using Laravel Breeze.
- CRUD for products (name, description, price, image, category).
- View and manage all orders with customer details.
- Product change logging (create, update, delete actions).

---

## Tech Stack

- Laravel Framework
- Blade Templates
- MySQL Database
- Laravel Breeze (Admin Authentication)
- Eloquent ORM

---

## Installation

1. **Clone the repository:**

    ```bash
    git clone https://github.com/AhmedHassan199/medical-ecommerce.git
    cd mini-medical-ecommerce
    ```

2. **Install PHP Dependencies:**

    ```bash
    composer install
    ```

3. **Install JavaScript Dependencies:**

    ```bash
    npm install
    npm run build
    ```

4. **Configure Environment:**

    - Duplicate `.env.example` and rename it to `.env`.
    - Update your DB credentials (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

5. **Generate Application Key:**

    ```bash
    php artisan key:generate
    ```

6. **Run Migrations and Seeders:**

    ```bash
    php artisan migrate --seed
    ```

7. **Start Development Server:**

    ```bash
    php artisan serve
    npm run dev
    ```

    App will run at `http://127.0.0.1:8000`.

---

## API / Web Routes

### Public Routes

| HTTP Method | URI                  | Action                             | Description                      |
|-------------|----------------------|------------------------------------|----------------------------------|
| GET         | /                    | ProductController@index            | Show product listing             |
| GET         | /products/{product}  | ProductController@show             | Show product details             |

### Cart Routes

| HTTP Method | URI                      | Action                     | Description                        |
|-------------|--------------------------|----------------------------|------------------------------------|
| POST        | /cart/add/{product}      | CartController@add         | Add product to cart                |
| GET         | /cart                    | CartController@index       | View cart                          |
| DELETE      | /cart/remove/{productId} | CartController@remove      | Remove product from cart           |
| PUT         | /cart/update/{productId} | CartController@update      | Update quantity in cart            |

### Order Routes

| HTTP Method | URI                          | Action                    | Description                       |
|-------------|------------------------------|---------------------------|-----------------------------------|
| GET         | /checkout                    | OrderController@checkout  | Checkout page                     |
| POST        | /orders                      | OrderController@store     | Submit new order                  |
| GET         | /orders/confirmation/{id}    | OrderController@confirmation | Order confirmation page       |

### Admin Routes (Requires Authentication & Admin Role)

| HTTP Method | URI                         | Action                                | Description                      |
|-------------|-----------------------------|---------------------------------------|----------------------------------|
| GET         | /dashboard                  | Dashboard view                        | Show admin dashboard             |
| Resource    | /admin/products             | ProductController (resource)          | CRUD for products                |
| GET         | /admin/orders               | OrderController@index                 | View all orders                  |
| GET         | /admin/orders/{order}       | OrderController@show                  | View order details               |
| GET         | /admin/logs                 | ProductLogController@index            | Product logs                     |
| GET         | /admin/logs/{product}       | ProductLogController@byProduct        | Logs for a specific product      |
| GET         | /admin/analytics-dashboard  | DashboardController@index             | Analytics dashboard              |
| GET         | /admin/recommendations      | RecommendationController@getAiRecommendations | Get AI recommendations    |
| GET         | /admin/ai_recommendations   | RecommendationController@index        | Show AI recommendations page     |

### User Profile Routes (Requires Authentication)

| HTTP Method | URI         | Action                    | Description             |
|-------------|-------------|---------------------------|-------------------------|
| GET         | /profile    | ProfileController@edit    | Edit profile            |
| PATCH       | /profile    | ProfileController@update  | Update profile          |
| DELETE      | /profile    | ProfileController@destroy | Delete account          |

---

## Database Schema

### users

| Column             | Type                 | Description                |
|--------------------|----------------------|----------------------------|
| id                 | bigint (PK)          | User ID                    |
| name               | string               | Full name                  |
| email              | string (unique)      | Email                      |
| email_verified_at  | timestamp (nullable) | Email verified time        |
| role_id            | unsignedBigInteger   | FK to roles                |
| password           | string               | Password hash              |
| remember_token     | string (nullable)    | Token                      |
| created_at         | timestamp            | Created                    |
| updated_at         | timestamp            | Updated                    |

### roles

| Column     | Type         | Description          |
|------------|--------------|----------------------|
| id         | bigint (PK)  | Role ID              |
| name       | string       | Role name (e.g. admin)|
| created_at | timestamp    | Created              |
| updated_at | timestamp    | Updated              |

### categories

| Column      | Type         | Description         |
|-------------|--------------|---------------------|
| id          | bigint (PK)  | Category ID         |
| name        | string       | Name                |
| description | text         | Description         |
| created_at  | timestamp    | Created             |
| updated_at  | timestamp    | Updated             |

### products

| Column      | Type         | Description          |
|-------------|--------------|----------------------|
| id          | bigint (PK)  | Product ID           |
| name        | string       | Name                 |
| description | text         | Description          |
| price       | decimal      | Price                |
| image       | string       | Image filename       |
| category_id | unsignedBigInteger | FK to categories  |
| created_at  | timestamp    | Created              |
| updated_at  | timestamp    | Updated              |

### product_logs

| Column     | Type         | Description            |
|------------|--------------|------------------------|
| id         | bigint (PK)  | Log ID                 |
| product_id | unsignedBigInteger | FK to products     |
| action     | string       | created, updated, etc. |
| changed_by | unsignedBigInteger | FK to users        |
| changes    | json         | Description of changes |
| created_at | timestamp    | Created                |
| updated_at | timestamp    | Updated                |

### orders

| Column           | Type         | Description         |
|------------------|--------------|---------------------|
| id               | bigint (PK)  | Order ID            |
| full_name        | string       | Customer name       |
| phone_number     | string       | Phone               |
| delivery_address | text         | Address             |
| total_price      | decimal      | Total price         |
| created_at       | timestamp    | Created             |
| updated_at       | timestamp    | Updated             |

### order_items

| Column     | Type         | Description            |
|------------|--------------|------------------------|
| id         | bigint (PK)  | Order item ID          |
| order_id   | unsignedBigInteger | FK to orders        |
| product_id | unsignedBigInteger | FK to products      |
| quantity   | integer      | Quantity               |
| price      | decimal      | Unit price at that time|
| created_at | timestamp    | Created                |
| updated_at | timestamp    | Updated                |

---

## External API Integrations

- **Gemini API Key** (for AI Recommendations):
  - AI-assisted product promotion suggestions are powered by **Gemini**. You need a valid API key to use it.

---
