Requirements: 
1. Git
2. PHP 8
3. MySQL 8
3. Composer
4. nodejs, npm


1. git clone https://github.com/elvendor/aloware-test-project.git && cd aloware-test-project
2. composer install --no-dev -a
3. php artisan key:generate
4. create database aloware
5. edit .env file, update db user and password to yours
6. php artisan migrate --seed --force
7. npm i
8. npm run build
9. php artisan serve
10. browse URL http://127.0.0.1:8000