# Rumsika 🏠

Rumsika is a **house leasing and hunting web application** built with Laravel. The platform connects **house seekers** with **landlords**, making it easy to find, list, and manage rental properties efficiently.

---

## 🚀 Project Overview

Finding a suitable house or tenant can be time‑consuming and inefficient. **Rumsika** simplifies this process by providing a centralized platform where:

* House seekers can search and view available rental houses
* Landlords can list and manage their vacant properties
* Both parties can interact through a structured and user‑friendly system

The project is fully developed using **Laravel**, ensuring a secure, scalable, and maintainable backend.

---

## 🛠️ Tech Stack

* **Backend:** Laravel (PHP Framework)
* **Frontend:** Blade Templates, Bootstrap
* **Database:** MySQL
* **Authentication:** Laravel built‑in authentication
* **Architecture:** MVC (Model–View–Controller)

---

## ✨ Key Features

### For House Seekers

* Browse and search available houses
* View detailed property information
* Filter houses based on preferences

### For Landlords

* List vacant houses
* Manage house listings
* Update house availability and details

### General Features

* User authentication and authorization
* Responsive UI with Bootstrap
* Secure data handling
* Clean and intuitive dashboard

---

## ⚙️ Installation & Setup

Follow the steps below to run the project locally:

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/rumsika.git
cd rumsika
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Environment Configuration

Create a `.env` file:

```bash
cp .env.example .env
```

Update database credentials in the `.env` file:

```env
DB_DATABASE=rumsika
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Run Migrations

```bash
php artisan migrate
```

### 6. Start the Development Server

```bash
php artisan serve
```

Visit the application at:

```
http://127.0.0.1:8000
```

---

## 📂 Project Structure

The project follows Laravel’s standard MVC structure:

* `app/` – Application logic (Models, Controllers)
* `resources/views/` – Blade templates (UI)
* `routes/web.php` – Web routes
* `database/migrations/` – Database schema

---

## 🎯 Use Case

* Individuals searching for rental houses
* Landlords managing and advertising vacant properties
* Property managers looking for a simple leasing solution

---

## 🤝 Contribution

Contributions are welcome!

1. Fork the repository
2. Create a new feature branch
3. Commit your changes
4. Open a pull request

---

## 📄 License

This project is open‑source and available under the **MIT License**.

---

## 👨‍💻 Author

**Mutwiri**
Laravel Developer | Web Solutions Enthusiast

---

> *Rumsika – Simplifying house leasing and house hunting through technology.*
