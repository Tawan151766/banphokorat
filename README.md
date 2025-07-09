php artisan optimize
php artisan key:generate
php artisan migrate
php artisan db:seed --class=PostTypeSeeder
php artisan db:seed --class=AdminSeeder
php artisan storage:link

<!-- .htaccess -->
RewriteEngine on
RewriteCond %{REQUEST_URI} !^public
RewriteRule ^(.*)$ public/$1 [L]
