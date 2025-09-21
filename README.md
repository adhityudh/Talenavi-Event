# 🎪 Talenavi Event - WordPress Application

<div align="center">

![WordPress](https://img.shields.io/badge/WordPress-6.8.2-blue.svg)
![PHP](https://img.shields.io/badge/PHP-8.1+-purple.svg)
![Bedrock](https://img.shields.io/badge/Bedrock-Latest-green.svg)
![Composer](https://img.shields.io/badge/Composer-2.x-orange.svg)

**WordPress Application Built with Roots Bedrock Framework**

</div>

---

## 📁 Direktori Overview

Ini adalah direktori aplikasi WordPress utama yang dibangun menggunakan Roots Bedrock framework. Direktori ini berisi semua file aplikasi WordPress, konfigurasi, dan dependensi yang dikelola dengan Composer.

### 🏗 Struktur Direktori

```
app/
├── .env.example              # Template environment variables
├── .gitignore               # Git ignore rules
├── composer.json            # PHP dependencies & project config
├── composer.lock            # Locked dependency versions
├── pint.json               # Laravel Pint configuration
├── wp-cli.yml              # WP-CLI configuration
├── config/                 # Application configurations
│   ├── application.php     # Main application config
│   └── environments/       # Environment-specific configs
│       ├── development.php # Development environment
│       └── staging.php     # Staging environment
├── sql/                    # Database files (if any)
└── web/                    # Web root directory
    ├── app/                # WordPress application files
    │   ├── mu-plugins/     # Must-use plugins
    │   ├── plugins/        # Regular plugins
    │   ├── themes/         # WordPress themes
    │   │   └── talenavi-event/  # Custom theme
    │   └── uploads/        # Media uploads
    ├── index.php           # WordPress entry point
    └── wp-config.php       # WordPress configuration
```

---

## 🚀 Quick Start

### Prerequisites

- **PHP**: 8.1 atau lebih tinggi
- **Composer**: 2.x
- **MySQL/MariaDB**: 5.7+ / 10.2+
- **Web Server**: Apache/Nginx

### 1. Install Dependencies

```bash
# Masuk ke direktori app
cd app/

# Install PHP dependencies
composer install
```

### 2. Environment Setup

```bash
# Copy environment template
cp .env.example .env

# Edit file .env dengan konfigurasi database Anda
nano .env
```

### 3. Environment Configuration

Edit file `.env` dengan konfigurasi berikut:

```env
# Database Configuration
DB_NAME='talenavi_event'
DB_USER='your_db_user'
DB_PASSWORD='your_db_password'
DB_HOST='localhost'

# WordPress URLs
WP_ENV='development'
WP_HOME='http://localhost:8080'
WP_SITEURL="${WP_HOME}/wp"

# Security Keys (Generate di: https://roots.io/salts.html)
AUTH_KEY='your-unique-auth-key'
SECURE_AUTH_KEY='your-unique-secure-auth-key'
LOGGED_IN_KEY='your-unique-logged-in-key'
NONCE_KEY='your-unique-nonce-key'
AUTH_SALT='your-unique-auth-salt'
SECURE_AUTH_SALT='your-unique-secure-auth-salt'
LOGGED_IN_SALT='your-unique-logged-in-salt'
NONCE_SALT='your-unique-nonce-salt'
```

### 4. Start Development Server

```bash
# Dari direktori theme
cd web/app/themes/talenavi-event/
php -S localhost:8080

# Atau dari direktori web
cd web/
php -S localhost:8080
```

---

## 📦 Dependencies

### Production Dependencies

| Package | Version | Description |
|---------|---------|-------------|
| `roots/wordpress` | 6.8.2 | WordPress core |
| `roots/wp-config` | 1.0.0 | WordPress configuration |
| `roots/bedrock-autoloader` | ^1.0 | Autoloader for mu-plugins |
| `vlucas/phpdotenv` | ^5.5 | Environment variable loader |
| `wpackagist-plugin/pods` | ^3.3 | Custom fields plugin |
| `wpackagist-theme/twentytwentyfive` | ^1.0 | Default WordPress theme |

### Development Dependencies

| Package | Version | Description |
|---------|---------|-------------|
| `laravel/pint` | ^1.18 | Code formatting tool |
| `wp-cli/wp-cli-bundle` | ^2 | WordPress CLI tools |
| `roave/security-advisories` | dev-latest | Security vulnerability checker |

---

## 🛠 Development Commands

### Composer Commands

```bash
# Install dependencies
composer install

# Update dependencies
composer update

# Install production dependencies only
composer install --no-dev --optimize-autoloader

# Check for security vulnerabilities
composer audit
```

### Code Quality

```bash
# Check code formatting
composer lint

# Fix code formatting
composer lint:fix

# Manual Pint commands
./vendor/bin/pint --test    # Check formatting
./vendor/bin/pint           # Fix formatting
```

### WP-CLI Commands

```bash
# Check WordPress status
wp core version

# Update WordPress
wp core update

# Install plugins
wp plugin install plugin-name --activate

# Database operations
wp db export backup.sql
wp db import backup.sql

# Cache operations
wp cache flush
```

---

## 🔧 Configuration

### Environment Files

- **`.env`**: Main environment configuration (tidak di-commit ke Git)
- **`.env.example`**: Template untuk environment variables
- **`config/application.php`**: Konfigurasi aplikasi utama
- **`config/environments/development.php`**: Konfigurasi development
- **`config/environments/staging.php`**: Konfigurasi staging

### WordPress Configuration

WordPress dikonfigurasi melalui:
- Environment variables (`.env`)
- Application config (`config/application.php`)
- Environment-specific config (`config/environments/`)

### Custom Theme

Theme custom "talenavi-event" terletak di:
```
web/app/themes/talenavi-event/
├── style.css           # Theme information & styles
├── functions.php       # Theme functionality
├── index.php          # Main template
├── header.php         # Header template
├── footer.php         # Footer template
├── single-event.php   # Event detail template
├── upcoming-events.php # Event listing template
└── assets/            # Theme assets
    ├── css/           # Stylesheets
    ├── js/            # JavaScript files
    └── images/        # Images
```

---

## 🗂 File Structure Details

### `/config/`
Berisi konfigurasi aplikasi WordPress:
- **`application.php`**: Konfigurasi utama aplikasi
- **`environments/`**: Konfigurasi spesifik environment

### `/web/`
Document root untuk web server:
- **`app/`**: Direktori aplikasi WordPress
- **`wp/`**: WordPress core files (dikelola Composer)
- **`index.php`**: Entry point WordPress
- **`wp-config.php`**: WordPress configuration loader

### `/web/app/`
Direktori aplikasi WordPress:
- **`mu-plugins/`**: Must-use plugins (auto-loaded)
- **`plugins/`**: Regular WordPress plugins
- **`themes/`**: WordPress themes
- **`uploads/`**: Media uploads

---

## 🔐 Security

### Environment Variables
- Semua konfigurasi sensitif disimpan di `.env`
- File `.env` tidak di-commit ke version control
- Gunakan `.env.example` sebagai template

### WordPress Security
- WordPress core dikelola melalui Composer
- Security updates otomatis melalui `roave/security-advisories`
- Konfigurasi keamanan di `config/application.php`

### File Permissions
```bash
# Set proper permissions
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;
chmod 600 .env
```

---

## 🚀 Deployment

### Production Setup

1. **Upload files** ke server
2. **Install dependencies**:
   ```bash
   composer install --no-dev --optimize-autoloader
   ```
3. **Configure environment**:
   ```bash
   cp .env.example .env
   # Edit .env dengan konfigurasi production
   ```
4. **Set file permissions**
5. **Configure web server** untuk point ke `/web/` directory

### Environment Variables untuk Production

```env
WP_ENV='production'
WP_HOME='https://yourdomain.com'
WP_SITEURL="${WP_HOME}/wp"
WP_DEBUG=false
WP_DEBUG_LOG=false
WP_DEBUG_DISPLAY=false
```

---

## 🧪 Testing

### Local Development

```bash
# Start development server
cd web/app/themes/talenavi-event/
php -S localhost:8080

# Access WordPress
# Frontend: http://localhost:8080
# Admin: http://localhost:8080/wp/wp-admin/
```

### Code Quality Testing

```bash
# Check code formatting
composer lint

# Fix code formatting issues
composer lint:fix
```

---

## 📚 Documentation

### Bedrock Documentation
- [Official Bedrock Docs](https://roots.io/bedrock/docs/)
- [Twelve-Factor WordPress](https://roots.io/twelve-factor-wordpress/)

### WordPress Development
- [WordPress Developer Handbook](https://developer.wordpress.org/)
- [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/)

### Theme Development
- [Theme Development Handbook](https://developer.wordpress.org/themes/)
- [Template Hierarchy](https://developer.wordpress.org/themes/basics/template-hierarchy/)

---

## 🐛 Troubleshooting

### Common Issues

**1. Composer Install Errors**
```bash
# Clear composer cache
composer clear-cache
composer install
```

**2. Permission Errors**
```bash
# Fix file permissions
chmod -R 755 web/app/uploads/
chmod 600 .env
```

**3. Database Connection Errors**
- Check `.env` database configuration
- Verify database server is running
- Test database connection manually

**4. WordPress Not Loading**
- Check web server configuration
- Verify document root points to `/web/`
- Check `.htaccess` file if using Apache

---

## 📞 Support

**Project**: Talenavi Event WordPress Application  
**Framework**: Roots Bedrock  
**WordPress Version**: 6.8.2  
**PHP Version**: 8.1+

Untuk bantuan lebih lanjut:
- [Bedrock Documentation](https://roots.io/bedrock/docs/)
- [Roots Community](https://discourse.roots.io/)
- [WordPress Support](https://wordpress.org/support/)

---

</div>
