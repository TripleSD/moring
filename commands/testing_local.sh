echo 'Copy .env to .env.tmp'
cp .env .env.tmp

echo 'Copy .env.testing file to .env file'
cp .env.testing.example .env

echo 'Clearing artisan config'
php artisan config:clear

echo 'Artisan key generation'
php artisan key:generate

echo 'Starting PHPunit'
./vendor/bin/phpunit

echo 'Removing .env file'
rm -f .env

echo 'Copy .env.tmp file to .env '
cp .env.tmp .env

echo 'Removing .env.tmp file'
rm -f .env.tmp

echo 'Caching artisan config'
php artisan config:cache
