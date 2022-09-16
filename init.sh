cp .env.example .env
./docker/bin/sail build && sleep 5
./docker/bin/sail up -d --remove-orphans && sleep 5
./docker/bin/sail down && sleep 2
./docker/bin/sail up -d --remove-orphans && sleep 2
./docker/bin/sail composer install
./docker/bin/sail artisan key:generate
./docker/bin/sail artisan migrate:fresh --seed
./docker/bin/sail php artisan scribe:generate