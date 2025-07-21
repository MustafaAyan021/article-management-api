# 📰 Laravel Articles Management API

A Laravel-based RESTful API for managing articles, including route versioning, soft deletes, custom middleware, model relationships, and more.

---

## ⚙️ How to Run the Project

### 📁 Step 1: Clone the Repository

```bash
git clone https://github.com/MustafaAyan021/article-management-api.git
cd articles-api-management-api
```

### 📦 Step 2: Install Dependencies

```bash
composer install
```

### 🛠️ Step 4: Configure Environment Variables

Edit the `.env` file to set your database credentials:

```
DB_DATABASE=your_database_name
```

### 🧱 Step 5: Run Migrations and Seeders

```bash
php artisan migrate:fresh --seed
```

### 🚀 Step 6: Serve the Application

```bash
php artisan serve
```

The API will now be accessible at:

```
http://localhost:8000/api/v1
```

---

## 📬 Postman Collection

To test the API, import the provided Postman collection:

```
https://blue-comet-748122.postman.co/workspace/My-Workspace~fdaa7b01-0b3b-4940-820e-bb5feec35849/collection/37046271-3ec552a5-8d99-4240-90f3-73e90b416621?action=share&creator=37046271 
```

---

## ✅ Done!

You’re all set! The Laravel Articles Management API is now running locally. Happy coding! 🎉