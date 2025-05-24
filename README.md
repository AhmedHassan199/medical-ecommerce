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

1. Clone the repository

```bash
git clone https://github.com/AhmedHassan199/medical-ecommerce.git
cd mini-medical-ecommerce
  ```

2. **Install Dependencies:**

    ```bash
    composer install   
    ```

    This installs the necessary PHP packages listed in the `composer.json`.
   
2. **Install JavaScript dependencies using npm:**
   
  ```bash
    npm install
    npm run build
    ```

3. **Configure Your Environment:**

    - Duplicate `.env.example` and rename it to `.env`.
    - Set up your database configuration in the `.env` file, updating the `DB_*` values to match your MySQL settings.

4. **Generate Application Key:**

    ```bash
    php artisan key:generate
    ```

    This generates the app key for encrypted sessions and data security.

5. **Run Migrations and Seeders:**

    ```bash
    php artisan migrate --seed
    ```

    This will create the database tables and populate them with initial data, including the default admin user.

6. **Start the Development Server:**

    ```bash
    php artisan serve
    npm run dev
    ```

    Your server will start running on `http://127.0.0.1:8000`.

---

## API / Web Routes

### Public Routes
| HTTP Method | URI                    | Action                                  | Description                       |
|-------------|------------------------|-----------------------------------------|---------------------------------|
| GET         | /                      | `ProductController@index`                | Show the main product listing    |
| GET         | /products/{product}     | `ProductController@show`                 | Show details of a specific product |

### Cart Routes
| HTTP Method | URI                      | Action                              | Description                        |
|-------------|--------------------------|-----------------------------------|----------------------------------|
| POST        | /cart/add/{product}       | `CartController@add`                | Add a product to the cart        |
| GET         | /cart                    | `CartController@index`              | View cart items                  |
| DELETE      | /cart/remove/{productId}  | `CartController@remove`             | Remove a product from the cart   |
| PUT         | /cart/update/{productId}  | `CartController@update`             | Update product quantity in the cart |

### Order Routes
| HTTP Method | URI                             | Action                              | Description                      |
|-------------|---------------------------------|-----------------------------------|--------------------------------|
| GET         | /checkout                       | `OrderController@checkout`          | Checkout page (collect customer info) |
| POST        | /orders                        | `OrderController@store`             | Submit a new order              |
| GET         | /orders/confirmation/{id}       | `OrderController@confirmation`      | Order confirmation page         |

### Admin Routes (Requires Authentication & Admin Role)
| HTTP Method | URI                             | Action                               | Description                        |
|-------------|---------------------------------|------------------------------------|----------------------------------|
| GET         | /dashboard                      | Show admin dashboard                |
| Resource    | /admin/products                 | `ProductController` (CRUD)          | Manage products (except show)    |
| GET         | /admin/orders                   | `OrderController@index`             | List all orders                  |
| GET         | /admin/orders/{order}           | `OrderController@show`              | View details of a specific order |
| GET         | /admin/logs                    | `ProductLogController@index`        | View product change logs         |
| GET         | /admin/logs/{product}          | `ProductLogController@byProduct`    | View logs for a specific product |
| GET         | /admin/analytics-dashboard     | `DashboardController@index`          | Show analytics dashboard         |
| GET         | /admin/recommendations         | `RecommendationController@getAiRecommendations` | Fetch AI-based recommendations |
| GET         | /admin/ai_recommendations      | `RecommendationController@index`    | Show AI recommendations page    |

### User Profile Routes (Requires Authentication)
| HTTP Method | URI            | Action                    | Description                  |
|-------------|----------------|---------------------------|------------------------------|
| GET         | /profile       | `ProfileController@edit`   | Edit user profile            |
| PATCH       | /profile       | `ProfileController@update` | Update user profile          |
| DELETE      | /profile       | `ProfileController@destroy`| Delete user account          |

---

> **Note:** All admin routes require login and admin role.

# Database Schema

## users

| Column             | Type               | Description                |
|--------------------|--------------------|----------------------------|
| id                 | bigint (Primary Key) | User ID                    |
| name               | string             | User's full name           |
| email              | string (unique)    | User's email address       |
| email_verified_at   | timestamp (nullable) | Email verification time    |
| role_id            | unsignedBigInteger | Foreign key to roles table |
| password           | string             | User password hash         |
| remember_token     | string (nullable)  | Token for "remember me"    |
| created_at         | timestamp          | Created timestamp          |
| updated_at         | timestamp          | Last update timestamp      |

**Relations:**

- `role_id` → `roles.id`  
- **One role has many users** (One-to-Many: roles → users)

---

## roles

| Column     | Type               | Description           |
|------------|--------------------|-----------------------|
| id         | bigint (Primary Key) | Role ID               |
| name       | string (unique)    | Role name (e.g., admin)|
| created_at | timestamp          | Created timestamp     |
| updated_at | timestamp          | Last update timestamp |

---

## categories

| Column      | Type               | Description              |
|-------------|--------------------|--------------------------|
| id          | bigint (Primary Key) | Category ID              |
| name        | string             | Category name            |
| description | text (nullable)    | Category description     |
| created_at  | timestamp          | Created timestamp        |
| updated_at  | timestamp          | Last update timestamp    |

---

## products

| Column      | Type               | Description                 |
|-------------|--------------------|-----------------------------|
| id          | bigint (Primary Key) | Product ID                 |
| name        | string             | Product name                |
| description | text (nullable)    | Product description         |
| price       | decimal(8,2)       | Product price               |
| image       | string (nullable)  | Product image filename      |
| category_id | unsignedBigInteger | Foreign key to categories   |
| created_at  | timestamp          | Created timestamp           |
| updated_at  | timestamp          | Last update timestamp       |

**Relations:**

- `category_id` → `categories.id`  
- **One category has many products** (One-to-Many: categories → products)

---

## product_logs

| Column     | Type               | Description                          |
|------------|--------------------|------------------------------------|
| id         | bigint (Primary Key) | Log ID                            |
| product_id | unsignedBigInteger | Foreign key to products             |
| action     | string             | Action performed (created, updated, deleted) |
| changed_by | unsignedBigInteger | Foreign key to users (admin who made the change) |
| changes    | json               | JSON object describing changes     |
| created_at | timestamp          | Created timestamp                  |
| updated_at | timestamp          | Last update timestamp              |

**Relations:**

- `product_id` → `products.id`  
- **One product has many product logs** (One-to-Many: products → product_logs)  
- `changed_by` → `users.id` (One user can make many product logs)

---

## orders

| Column           | Type               | Description               |
|------------------|--------------------|---------------------------|
| id               | bigint (Primary Key) | Order ID                 |
| full_name        | string             | Customer full name        |
| phone_number     | string             | Customer phone number     |
| delivery_address | text               | Delivery address          |
| total_price      | decimal(10,2)      | Total order price         |
| created_at       | timestamp          | Created timestamp         |
| updated_at       | timestamp          | Last update timestamp     |

---

## order_items

| Column     | Type               | Description                |
|------------|--------------------|----------------------------|
| id         | bigint (Primary Key) | Order item ID              |
| order_id   | unsignedBigInteger | Foreign key to orders       |
| product_id | unsignedBigInteger | Foreign key to products     |
| quantity   | integer            | Quantity ordered           |
| price      | decimal(8,2)       | Price per unit at order time|
| created_at | timestamp          | Created timestamp          |
| updated_at | timestamp          | Last update timestamp      |

**Relations:**

- `order_id` → `orders.id`  
- **One order has many order items** (One-to-Many: orders → order_items)  
- `product_id` → `products.id`  
- **One product can be in many order items** (One-to-Many: products → order_items)

## **External API Integrations**

. **Gemini API Key** (For AI Recommendations)
    - AI-assisted product promotion suggestions are powered by **Gemini**. You will need an API key for access.





