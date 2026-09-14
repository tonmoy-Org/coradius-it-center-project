#!/bin/bash

# Exit on error
set -e

echo "=========================================================="
echo " Starting Coradius IT Center Deployment Setup on Ubuntu VPS"
echo "=========================================================="

# Define variables
DOMAIN="coradiusitcenter.com"
DB_NAME="coradius_db"
DB_USER="anik"
DB_PASS="123456789"
PROJECT_DIR="/var/www/coradiusitcenter"
REPO_URL="https://github.com/tonmoy-Org/coradius-it-center-project.git"

echo "[1/10] Updating system packages..."
apt-get update
apt-get upgrade -y

echo "[2/10] Installing required packages (Nginx, MySQL, PHP 8.1, Git, Certbot)..."
apt-get install -y software-properties-common curl git unzip
add-apt-repository ppa:ondrej/php -y
apt-get update
apt-get install -y nginx mariadb-server certbot python3-certbot-nginx
apt-get install -y php8.1-fpm php8.1-mysql php8.1-mbstring php8.1-xml php8.1-bcmath php8.1-curl php8.1-zip php8.1-gd

echo "[3/10] Installing Composer..."
if ! command -v composer &> /dev/null
then
    curl -sS https://getcomposer.org/installer | php
    mv composer.phar /usr/local/bin/composer
fi

echo "[4/10] Setting up MySQL Database..."
mysql -uanik -p123456789 -e "CREATE DATABASE IF NOT EXISTS ${DB_NAME} CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
echo "Database credentials created: DB=${DB_NAME} User=${DB_USER} Password=${DB_PASS}"

echo "[5/10] Cloning repository to ${PROJECT_DIR} (Branch: Full-changes-Update)..."
if [ -d "$PROJECT_DIR/.git" ]; then
    echo "Directory ${PROJECT_DIR} already exists. Fetching and checking out Full-changes-Update..."
    cd $PROJECT_DIR
    git fetch origin Full-changes-Update
    git checkout Full-changes-Update
    git pull origin Full-changes-Update
else
    git clone -b Full-changes-Update $REPO_URL $PROJECT_DIR
    cd $PROJECT_DIR
    git checkout Full-changes-Update
fi

echo "[6/10] Setting up .env file..."
if [ ! -f ".env" ]; then
    cp .env.example .env
fi

# Update .env variables
sed -i "s/^APP_URL=.*/APP_URL=https:\/\/${DOMAIN}/" .env
sed -i "s/^APP_ENV=.*/APP_ENV=production/" .env
sed -i "s/^APP_DEBUG=.*/APP_DEBUG=false/" .env
sed -i "s/^DB_DATABASE=.*/DB_DATABASE=${DB_NAME}/" .env
sed -i "s/^DB_USERNAME=.*/DB_USERNAME=${DB_USER}/" .env
sed -i "s/^DB_PASSWORD=.*/DB_PASSWORD=${DB_PASS}/" .env

echo "[7/10] Installing PHP dependencies..."
composer config policy.advisories.block false
composer install --optimize-autoloader --no-dev

echo "[8/10] Running Artisan Commands..."
php artisan key:generate --force
php artisan migrate --force
php artisan storage:link

echo "Clearing cache professionally..."
php artisan optimize:clear

echo "[9/10] Setting file permissions..."
chown -R www-data:www-data $PROJECT_DIR
chmod -R 775 $PROJECT_DIR/storage
chmod -R 775 $PROJECT_DIR/bootstrap/cache

echo "[10/10] Configuring Nginx..."
NGINX_CONF="/etc/nginx/sites-available/${DOMAIN}"
cat <<EOF > $NGINX_CONF
server {
    listen 80;
    server_name ${DOMAIN} www.${DOMAIN};
    root ${PROJECT_DIR}/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php\$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
EOF

# Enable Nginx block
ln -sf /etc/nginx/sites-available/${DOMAIN} /etc/nginx/sites-enabled/
# Remove default nginx config if exists
rm -f /etc/nginx/sites-enabled/default

# Test and reload Nginx
nginx -t
systemctl reload nginx

echo "=========================================================="
echo " Deployment Complete! Requesting SSL Certificate via Let's Encrypt..."
echo "=========================================================="
certbot --nginx -d ${DOMAIN} -d www.${DOMAIN} --non-interactive --agree-tos -m admin@${DOMAIN} || true

echo "Setup is fully complete. The project is live at https://${DOMAIN}"
echo "Database Details: DB=${DB_NAME} User=${DB_USER} Password=${DB_PASS}"
