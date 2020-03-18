echo 'Copy env to env.tmp'
cp .env .env.tmp

echo 'Copy env testing to env'
cp .env.testing.example .env

php artisan config:clear
php artisan key:generate

./vendor/bin/phpunit
rm -f .env
cp .env.tmp .env
rm -f .env.tmp
php artisan config:cache
