cp .env .env.tmp
cp .env.testing.example .env
php artisan key:generate
php artisan config:cache --env=testing
./vendor/bin/phpunit
rm -f .env
cp .env.tmp .env
rm -f .env.tmp
php artisan config:cache
