git pull origin dev
php artisan migrate
php artisan config:cache --env=testing
./vendor/bin/phpunit
php artisan config:cache
