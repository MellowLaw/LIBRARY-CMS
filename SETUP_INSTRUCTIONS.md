# Library CMS - Complete Setup Instructions

## ✅ ALL FEATURES IMPLEMENTED AND READY TO USE!

This guide will walk you through setting up and running the Library CMS system step by step.

---

## Step 1: Install Dependencies

### Install PHP Dependencies
```bash
composer install
```

### Install Node Dependencies
```bash
npm install
```

---

## Step 2: Environment Configuration

### Copy Environment File
```bash
copy .env.example .env
```
(On Linux/Mac: `cp .env.example .env`)

### Generate Application Key
```bash
php artisan key:generate
```

### Configure Database
Edit `.env` file and set your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=library_cms
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

**OR** use SQLite (easier for development):
```env
DB_CONNECTION=sqlite
DB_DATABASE=C:\xampp\htdocs\library-cms\database\database.sqlite
```
(Remove DB_HOST, DB_PORT, DB_USERNAME, DB_PASSWORD lines)

---

## Step 3: Database Setup

### Create Database (if using MySQL)
Create a database named `library_cms` in your MySQL server.

### Run Migrations
```bash
php artisan migrate
```

### Seed Database (Create Admin Users)
```bash
php artisan db:seed
```

This will create 3 users:
- **Admin**: `admin@library.com` / `password`
- **Librarian**: `librarian@library.com` / `password`
- **Viewer**: `viewer@library.com` / `password`

---

## Step 4: Storage Setup

### Create Storage Link (for file uploads)
```bash
php artisan storage:link
```

This allows staff profile images to be accessible via the web.

---

## Step 5: Build Frontend Assets

### Build Assets for Production
```bash
npm run build
```

### OR Run Development Server (with hot reload)
```bash
npm run dev
```
(Keep this running in a separate terminal)

---

## Step 6: Clear Caches

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

---

## Step 7: Start the Server

### Start Laravel Development Server
```bash
php artisan serve
```

The application will be available at: **http://localhost:8000**

---

## Step 8: Access the System

### Login
1. Open your browser and go to: `http://localhost:8000`
2. You'll be redirected to the login page
3. Use one of these credentials:
   - **Admin**: `admin@library.com` / `password`
   - **Librarian**: `librarian@library.com` / `password`
   - **Viewer**: `viewer@library.com` / `password`

### After Login
You'll be redirected to the **Dashboard** where you can:
- View statistics
- Access all management features
- Create and manage content

---

## Available Features

### ✅ Pages Management
- Create, edit, delete pages
- Schedule publication
- Preview before publishing
- WYSIWYG editor for content

### ✅ Menu Management
- Create menu items
- Drag and drop reordering
- Parent/child menu structure
- Show/hide menu items

### ✅ Staff Management
- Add staff profiles
- Upload profile images
- Manage positions and bios
- Publish/unpublish staff

### ✅ Resource Links
- Add resource links
- Categorize resources
- Mark as internal/external
- Activate/deactivate links

### ✅ Public Preview
- View public-facing website
- See published pages
- Browse staff and resources

---

## Quick Start Commands (All in One)

If you want to set everything up quickly, run these commands in order:

```bash
# 1. Install dependencies
composer install
npm install

# 2. Setup environment
copy .env.example .env
php artisan key:generate

# 3. Configure database in .env file (edit manually)

# 4. Setup database
php artisan migrate
php artisan db:seed

# 5. Setup storage
php artisan storage:link

# 6. Build assets
npm run build

# 7. Clear caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# 8. Start server
php artisan serve
```

Then open: **http://localhost:8000**

---

## Troubleshooting

### Issue: "Class not found" errors
**Solution**: Run `composer dump-autoload`

### Issue: "Route not found" errors
**Solution**: Run `php artisan route:clear` and `php artisan route:cache`

### Issue: "View not found" errors
**Solution**: Run `php artisan view:clear`

### Issue: CSS/JS not loading
**Solution**: 
1. Make sure you ran `npm run build` or `npm run dev`
2. Check that Vite is running if using `npm run dev`
3. Clear browser cache

### Issue: Images not showing
**Solution**: 
1. Run `php artisan storage:link`
2. Check `storage/app/public` folder exists
3. Ensure file permissions are correct

### Issue: Database connection error
**Solution**:
1. Check `.env` file has correct database credentials
2. Make sure database exists
3. Check MySQL/XAMPP is running

### Issue: Login not working
**Solution**:
1. Make sure you ran `php artisan db:seed` to create users
2. Check database has users table with data
3. Clear session: `php artisan session:flush`

---

## Testing the System

### Test Login
1. Go to `http://localhost:8000`
2. Login with `admin@library.com` / `password`
3. Should redirect to dashboard

### Test Pages
1. Click "Pages" in sidebar
2. Click "New Page"
3. Fill in title and slug
4. Click "Create Page"
5. Should see success message

### Test Menus
1. Click "Menus" in sidebar
2. Click "New Menu Item"
3. Fill in form and save
4. Try drag and drop reordering

### Test Staff
1. Click "Staff" in sidebar
2. Click "Add Staff Member"
3. Fill in form and upload image
4. Save and verify

### Test Resources
1. Click "Resources" in sidebar
2. Click "Add Resource"
3. Fill in URL and details
4. Save and verify

### Test Preview
1. Click "Preview" button in navbar
2. Should see public-facing website
3. Click on published pages

---

## API Endpoints

The system also has a RESTful API. Test with:

### Get Token (Login)
```bash
POST http://localhost:8000/api/auth/login
Content-Type: application/json

{
    "email": "admin@library.com",
    "password": "password"
}
```

### Use Token
```bash
GET http://localhost:8000/api/pages
Authorization: Bearer YOUR_TOKEN_HERE
```

---

## Production Deployment

### Before Deploying:
1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false` in `.env`
3. Run `php artisan config:cache`
4. Run `php artisan route:cache`
5. Run `php artisan view:cache`
6. Run `npm run build` (not `npm run dev`)
7. Set up proper database
8. Configure web server (Apache/Nginx)
9. Set up SSL/HTTPS
10. Configure proper file permissions

---

## System Status

✅ **All Features Implemented:**
- Authentication & Authorization
- Pages Management (CRUD)
- Menu Management (CRUD + Drag-drop)
- Staff Management (CRUD + File Upload)
- Resource Links (CRUD)
- Public Preview
- WYSIWYG Editor
- Schedule Publication
- Audit Logging
- Security Features
- API Endpoints

✅ **All Views Created:**
- Login
- Dashboard
- Pages (index, create, edit, show)
- Menus (index, create, edit)
- Staff (index, create, edit)
- Resources (index, create, edit)
- Public (home, page)

✅ **All Routes Configured:**
- Web routes (with authentication)
- API routes (with Sanctum)
- Public routes

---

## Next Steps After Setup

1. **Change Default Passwords**: Update admin user passwords
2. **Add Content**: Create pages, menus, staff, resources
3. **Customize**: Modify views and styling as needed
4. **Test**: Test all features thoroughly
5. **Document**: Add your own documentation if needed

---

## Support

If you encounter any issues:
1. Check the troubleshooting section above
2. Check Laravel logs: `storage/logs/laravel.log`
3. Check browser console for JavaScript errors
4. Verify all dependencies are installed
5. Ensure database is properly configured

---

## ✅ YOU'RE READY TO GO!

The system is fully functional. Just follow the steps above and you'll be up and running in minutes!

**Happy coding! 🚀**

