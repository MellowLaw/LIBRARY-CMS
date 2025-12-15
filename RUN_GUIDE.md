# LibraryCMS - System Guide

## **1. Project Overview**
This is a **Library Content Management System (CMS)** built with **Laravel 11**, **Tailwind CSS**, and **Alpine.js**. It features a dual-interface system:
1.  **Public Library**: For users to browse, search, and view book details.
2.  **User Dashboard ("My Library")**: For regular users to manage their profile and see borrowed books.
3.  **Admin Panel**: For librarians to manage Books, Authors, Categories, and CMS pages.

---

## **2. Prerequisites**
Before running the system, ensure you have the following installed:
*   **XAMPP** (or any PHP environment with MySQL)
*   **Composer** (PHP Dependency Manager)
*   **Node.js & NPM** (For compiling styles)
*   **Git**

---

## **3. Installation Steps**

### **Step 1: Clone & Install Dependencies**
Open your terminal in the project folder:
```bash
# Install PHP dependencies
composer install

# Install Frontend dependencies
npm install
```

### **Step 2: Environment Setup**
1.  Copy the example environment file:
    ```bash
    cp .env.example .env
    ```
2.  Open `.env` and configure your database settings:
    ```ini
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=library_cms
    DB_USERNAME=root
    DB_PASSWORD=
    ```
3.  Generate the application key:
    ```bash
    php artisan key:generate
    ```

### **Step 3: Database & Seeding**
Run the migrations and seed the database with sample data (Books, Authors, Users):
```bash
php artisan migrate:fresh --seed
```
> **Note**: This creates default accounts (Admin and Viewer) and populates the library with dummy books.

### **Step 4: Build Assets**
Compile the Tailwind CSS and Javascript files:
```bash
npm run build
```

---

## **4. Running the Application**
To start the local development server:
```bash
php artisan serve
```
The site will be accessible at: **`http://localhost:8000`**

---

## **5. How to Navigate**

### **Default Login Credentials**
*   **Admin Account**:
    *   **Email**: `admin@library.com`
    *   **Password**: `password`
*   **Viewer Account**:
    *   **Email**: `viewer@library.com`
    *   **Password**: `password`

### **Role-Based Navigation**

#### **1. Public Visitor (Not Logged In)**
*   **Home (`/`)**: Landing page displaying latest News, Pages, and Staff profiles.
*   **News (`/public/news`)**: Read announcements and updates.
*   **Sign In**: Click "Login" in the URL bar manually (or add a link in your template) to access the Admin Panel.

#### **2. Regular User ("Viewer")**
*   **Login**: Use the *Viewer Account*.
*   **Dashboard**: Clicking "Dashboard" redirects you to **"My Library"** (`/library/my-dashboard`).
    *   Here you can see your profile and status.
    *   Future features will list your "Borrowed Books" here.
*   **Logout**: Accessible via the Profile Dropdown in the top right.

#### **3. Administrator ("Admin")**
*   **Login**: Use the *Admin Account*.
*   **Admin Dashboard**: Clicking "Dashboard" takes you to the **CMS Backend**.
*   **Content Management**:
    *   **Pages**: Manage the "Vision", "Mission", and other static content.
    *   **News**: Post announcements and updates.
    *   **Staff**: Manage staff profiles showcased on the public site.
    *   **Menus**: Organize the website navigation.

---

## **6. Troubleshooting**
*   **"Images Broken"**: Ensure you ran `php artisan storage:link` (usually done automatically, but good to check).
*   **"Dropdown not clicking"**: Hard refresh (`Ctrl + F5`) to clear old JS caches.
*   **"Database Error"**: Ensure XAMPP MySQL is running and `migrate:fresh --seed` was successful.
