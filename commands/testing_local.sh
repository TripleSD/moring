echo 'Copy .env to .env.tmp'
cp .env .env.tmp

echo 'Copy .env.testing file to .env file'
cp .env.testing.example .env

echo 'Clearing artisan config'
php artisan config:clear

echo 'Artisan key generation'
php artisan key:generate

echo 'Starting SNMP servers'
python utils/snmp-server/snmp-server.py -p 9001 -c utils/snmp-server/configs/CloudMikrotik.py &
PID1=$!

python utils/snmp-server/snmp-server.py -p 9002 -c utils/snmp-server/configs/Cisco.py &
PID2=$!

python utils/snmp-server/snmp-server.py -p 9003 -c utils/snmp-server/configs/DLink.py &
PID3=$!

python utils/snmp-server/snmp-server.py -p 9004 -c utils/snmp-server/configs/Eltex.py &
PID4=$!

python utils/snmp-server/snmp-server.py -p 9005 -c utils/snmp-server/configs/HardwareMikrotik.py &
PID5=$!

echo 'Starting PHPunit'
#./vendor/bin/phpunit --coverage-html report_coverage
./vendor/bin/phpunit
#./vendor/bin/phpunit --filter testGetSerialNumber tests/Unit/SNMP/CloudMikrotikEmptyOIDTest.php

echo 'Killing SNMP servers'
kill $PID1 $PID2 $PID3 $PID4 $PID5

echo 'Removing .env file'
rm -f .env

echo 'Copy .env.tmp file to .env '
cp .env.tmp .env

echo 'Removing .env.tmp file'
rm -f .env.tmp

echo 'Caching artisan config'
php artisan config:cache
