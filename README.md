# Personal Portfolio Website (iOS 6 Classic Edition) + Admin Dashboard CMS

An interactive retro-skeuomorphic portfolio website styled after **iOS 6 Classic Edition** (dark linen background, glossy squircle icons, glossy navigation buttons, pinstripe cards, and yellow lined paper notes), built with the **Laravel 13** framework and a **MySQL** database.

All portfolio content can be managed dynamically through an authentication-protected **Admin Web Dashboard**.

---

## 🚀 Key Features

### 1. Public Portfolio Pages
- **Hero & Profile Card**: Glossy squircle avatar, "OPEN TO WORK" availability badge, name, role, bio, and action buttons.
- **Slide-to-Unlock CV Resume**: Interactive slider for downloading the original CV PDF uploaded by the admin.
- **Home Screen App Grid (Skills)**: A grid of 6+ glossy iOS 6 app icons with interactive notification banners that display tools and skills when tapped or clicked.
- **Portfolio Showcase (Grouped Table)**:
  - Category filters (*All*, *App*, *Web*).
  - Project cards with thumbnails, category badges, and technology lists.
  - A dark blue glass *UIAlertView* modal for reading full descriptions, technology stack details, and live demo and GitHub repository links.
- **Preferences & Work Availability**: iOS 6-style ON/OFF switches and location or base-of-operations information.
- **Notes App Section**: Career notes and design philosophies with *yellow lined paper* texture and a *leather header*.
- **Contact Modal Form (AJAX)**: Visitors can send messages without refreshing the page. Submissions are protected with CSRF and stored in MySQL.

### 2. Authentication & Admin Dashboard
- **Login Security**:
  - Login page at `/admin/login`.
  - Built-in rate limiter (maximum of 5 failed attempts per minute).
  - Encrypted sessions and `auth` middleware protection for every `/admin/*` route.
- **Overview**: Metrics for total projects, skills, unread messages, work availability status, and the latest incoming message log.
- **Profile & CV Management**: Forms to update the name, headline, role, and bio; upload an avatar with automatic preview; upload a new CV PDF; and update the resume version number.
- **Project Management (CRUD)**: Create, edit, and delete portfolio projects, including cover or thumbnail images, technology tags, and live demo links.
- **Skill Management (CRUD)**: Manage the Home Screen app list, Font Awesome icons, iOS 6 color gradient presets, and display order.
- **Experience Management (CRUD)**: Add and update career history in the Notes App section.
- **Philosophy Notes Management**: Edit the header, date, main title, and reflective text.
- **Message Inbox**: Read visitor messages, mark messages as read, reply through *mailto*, and delete messages.
- **Account & Security**: Change the account name or login email, and update the admin password after verifying the current password.

---

## 🛠️ System Requirements
- **PHP** >= 8.3 (supports PHP 8.4 and 8.5)
- **Composer** >= 2.x
- **MySQL** >= 8.0 (or MariaDB / SQLite for local testing)
- **Node.js & npm** (optional; Tailwind CSS CDN and Font Awesome are integrated)

---

## 📦 Installation and Running

### 1. Clone the Project
```bash
git clone https://github.com/alecgun/portfolio-ios6-style.git
cd portfolio-ios6-style
```

### 2. Copy the Environment Configuration File
```bash
cp .env.example .env
```

### 3. Configure the MySQL Database
Open `.env` and update the MySQL connection and initial admin credentials:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio_db
DB_USERNAME=root
DB_PASSWORD=

ADMIN_NAME="Admin Name"
ADMIN_EMAIL=admin@example.com
ADMIN_PASSWORD=replace-with-random-password-minimum-8-characters
```
> *Note: Make sure the `portfolio_db` database has already been created on your MySQL server.*
>
> Use a unique random password. Do not commit `.env` or use the example password in production.

### 4. Install PHP Dependencies (if needed)
```bash
composer install
```

### 5. Generate the Application Key and Create the Storage Link
```bash
php artisan key:generate
php artisan storage:link
```

### 6. Run Migrations and Seed Initial Data
This creates the tables and imports the profile, skills, experience, and initial notes, and creates the admin account from the `ADMIN_*` values. Example projects are not seeded; add yours from the dashboard.
```bash
php artisan migrate --seed
```

### 7. Start the Local Server
```bash
php artisan serve
```
Access the portfolio website in your browser:
- **Public Portfolio Page**: [http://127.0.0.1:8000](http://127.0.0.1:8000)
- **Admin Login Page**: [http://127.0.0.1:8000/admin/login](http://127.0.0.1:8000/admin/login)

---

## 🚀 Production Setup

Configure the following values through a secret manager or hosting environment variables instead of the repository:

```ini
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com
SESSION_SECURE_COOKIE=true
LOG_CHANNEL=daily
```

Also set the database connection and strong values for `ADMIN_NAME`, `ADMIN_EMAIL`, and `ADMIN_PASSWORD` (minimum 8 characters). Use HTTPS through a hosting provider or reverse proxy, and never run `key:generate` again after the production application begins storing data.

Build dependencies and assets during deployment:

```bash
composer install --no-dev --optimize-autoloader
npm install
npm run build
php artisan migrate --force
php artisan storage:link
php artisan optimize
```

Run `php artisan db:seed --force` only during the first installation to create the admin account and initial content without example projects. Do not run the seeder for every deployment. Back up the database before migrations, and do not commit `.env`, SQLite databases, logs, or uploaded files.

---

## 🧪 Running Automated Tests
The unit and feature tests cover all modules:
```bash
php artisan test
```
The tests verify public rendering, the AJAX contact form, admin route protection, authentication flows, and portfolio CRUD operations.
