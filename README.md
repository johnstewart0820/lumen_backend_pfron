## How to install the environment and start

- Make sure your composer version is over `2`.
  You can check the composer version with command `composer --version`.

- Install dependencies: `composer install`

- Create Mysql Database name as `monza_monza`

- Database migration with seed: `php artisan migrate:fresh --seed`

- Start the server: `php -S localhost:8000 -t public`

- Views are on: `localhost:8000`
