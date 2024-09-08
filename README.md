Required stack and their versions:

PHP:8.1
Laravel:10


To install project clone project using below command:

1. Unzip project folder.
2. Run command: 'cd test-rin2'
3. Run below commands to run project on local machine
npm run 
php artisan serve
4. There is a test-rin2.sql file on root folder, which contains database.
5. Create database and import this sql file to create a database on your local machine.
6. If you don't want to use this database, you can create a database and run following command. It will generate tables.
php artisan migrate
7. Create .env file from .env.example. Add database details in this file
8. To generate unique app key, run below command:
php artisan key:generate
9. Now you can run project in browser. 
Link: http://127.0.0.1:8000/


