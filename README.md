# 🚀 Laravel URL Shortener with Multi-Role Access

A Laravel project that allows users to generate and manage short URLs with role-based dashboards and a secure invitation system.

---

## 🛠️ Project Setup Instructions (Local Testing)

Follow the steps below to set up and test this project on your local machine:

---

### 1. Clone the Repository
```bash
git clone https://github.com/your-username/laravel-url-shortener.git
cd laravel-url-shortener

Step 2) . Install Composer & NPM Dependencies
composer install
npm install && npm run build

Step 3). Set Up the .env File
cp .env.example .env

.env file code:
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:t7bXU7IYwqJcxcxk5rfg2igYubV6OrygcyLThDT8Ah4=
APP_DEBUG=true
APP_URL=http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=url_shortner
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
# CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

# MAIL_MAILER=log
# MAIL_SCHEME=null
# MAIL_HOST=127.0.0.1
# MAIL_PORT=2525
# MAIL_USERNAME=null
# MAIL_PASSWORD=null
# MAIL_FROM_ADDRESS="hello@example.com"
# MAIL_FROM_NAME="${APP_NAME}"
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=7dc4ca12d2c1d5
MAIL_PASSWORD=7445ac4c053093
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=no-reply@yourapp.com
MAIL_FROM_NAME="URL Shortener App"


AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"

Step 4) Set up the database local my sql file :

I am providing you database sql file in email you can import this file in your local database

Database name  : url_shortner

Step 5 )

login Creditional:

a) superadmin login:
Email : superadmin@example.com
password : superadmin@123

b) admin login:
email : admin@example.com
password : password

c) member login:
email : member@example.com
password : password



Step 6 )
 Start the Application
php artisan serve
Visit in browser:
👉 http://127.0.0.1:8000

🔑 Features
✅ Multi-company support

✅ Role-based dashboards

✅ SuperAdmin can view all short URLs

✅ Admins can create short URLs and manage users within their company

✅ Members can generate and manage their own short URLs

✅ URL shortening + redirecting with click tracking

✅ Secure invitation system via email



