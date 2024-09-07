npm install
componser install

Inside the .env file, update the 
DB_DATABASE= your absolute path

It shouldn't be empty, but in case the database file is empty, run:
php artisan migrate
php artisan db:seed

npm run build
php artisan serve