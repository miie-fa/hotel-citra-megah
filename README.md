How to run this project ->
composer install
npm install
cp .env .env.example
*set your database first
php artisan migrate:fresh --seed
php artisan storage:link
php artisan db:seed --class=DatabaseSeeder
php artisan db:seed --class=HomeSeeder
php artisan db:seed --class=UserTableSeeder
<!-- php artisan migrate --seed -->

