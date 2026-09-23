#!/bin/bash
##############################################################################
#  Coradius IT Center – Performance Deploy Script (PageSpeed 90+)
#  Run: bash /var/www/coradiusitcenter/deploy_performance.sh
##############################################################################
set -e

SITE_ROOT="/var/www/coradiusitcenter"
NGINX_CONF="/etc/nginx/sites-available/coradiusitcenter"
PHP_INI="/etc/php/8.3/fpm/php.ini"
PHP_FPM_CONF="/etc/php/8.3/fpm/pool.d/www.conf"
OPCACHE_CONF="/etc/php/8.3/fpm/conf.d/10-opcache.ini"

echo "========================================"
echo " Coradius IT Center - Performance Deploy"
echo "========================================"

cd "$SITE_ROOT"

# ─── 1. Pull latest code ──────────────────────────────────────────────────
echo "[1/10] Pulling latest code from git..."
git pull origin main

# ─── 2. Install/update PHP dependencies ───────────────────────────────────
echo "[2/10] Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# ─── 3. Laravel optimizations ─────────────────────────────────────────────
echo "[3/10] Running Laravel optimizations..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# ─── 4. Nginx config ──────────────────────────────────────────────────────
echo "[4/10] Updating Nginx config..."
cp "$SITE_ROOT/nginx_coradius.conf" "$NGINX_CONF"

# Test nginx config before reloading
nginx -t && echo "   ✓ Nginx config valid" || { echo "✗ Nginx config ERROR"; exit 1; }

# ─── 5. OPcache configuration ─────────────────────────────────────────────
echo "[5/10] Configuring PHP OPcache..."
cat > "$OPCACHE_CONF" << 'OPCACHE'
zend_extension=opcache
opcache.enable=1
opcache.enable_cli=1
opcache.memory_consumption=256
opcache.interned_strings_buffer=16
opcache.max_accelerated_files=20000
opcache.revalidate_freq=0
opcache.validate_timestamps=0
opcache.fast_shutdown=1
opcache.save_comments=1
opcache.huge_code_pages=1
opcache.jit=tracing
opcache.jit_buffer_size=128M
OPCACHE
echo "   ✓ OPcache configured"

# ─── 6. PHP-FPM pool tuning ───────────────────────────────────────────────
echo "[6/10] Tuning PHP-FPM pool..."
# Set pm to dynamic for better performance
sed -i 's/^pm = .*/pm = dynamic/' "$PHP_FPM_CONF"
sed -i 's/^pm.max_children = .*/pm.max_children = 50/' "$PHP_FPM_CONF"
sed -i 's/^pm.start_servers = .*/pm.start_servers = 5/' "$PHP_FPM_CONF"
sed -i 's/^pm.min_spare_servers = .*/pm.min_spare_servers = 5/' "$PHP_FPM_CONF"
sed -i 's/^pm.max_spare_servers = .*/pm.max_spare_servers = 35/' "$PHP_FPM_CONF"
echo "   ✓ PHP-FPM pool tuned"

# ─── 7. Storage permissions ───────────────────────────────────────────────
echo "[7/10] Fixing storage permissions..."
chown -R www-data:www-data "$SITE_ROOT/storage" "$SITE_ROOT/bootstrap/cache"
chmod -R 775 "$SITE_ROOT/storage" "$SITE_ROOT/bootstrap/cache"
echo "   ✓ Permissions fixed"

# ─── 8. Enable Nginx site & reload services ───────────────────────────────
echo "[8/10] Reloading services..."
ln -sf "$NGINX_CONF" /etc/nginx/sites-enabled/coradiusitcenter 2>/dev/null || true
systemctl reload nginx
systemctl restart php8.3-fpm
echo "   ✓ Nginx & PHP-FPM reloaded"

# ─── 9. Clear all caches after restart ────────────────────────────────────
echo "[9/10] Clearing application caches..."
php artisan cache:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo "   ✓ Caches rebuilt"

# ─── 10. Optimize images (WebP conversion if cwebp available) ─────────────
echo "[10/10] Checking image optimization tools..."
if command -v cwebp &> /dev/null; then
    echo "   ✓ cwebp found - WebP conversion available"
else
    echo "   ℹ cwebp not found - install with: apt install webp"
fi

echo ""
echo "========================================"
echo " ✅ Deploy Complete!"
echo "========================================"
echo ""
echo " Site: https://coradiusitcenter.com"
echo " Run PageSpeed test: https://pagespeed.web.dev/report?url=https://coradiusitcenter.com"
echo ""
