# laravel_car
lebanese university laravel first project
# Step 1: Delete the vendor directory
rm -rf vendor

# Step 2: Install dependencies
composer install

# Step 3: Create the database manually in phpMyAdmin (No command for this step)

# Step 4: Update the .env file with correct database credentials
# Open .env and make sure these lines match your database:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=cars2
# DB_USERNAME=root
# DB_PASSWORD=

# Step 5: Execute the SQL code in phpMyAdmin (No command for this step)

# Step 6: Copy the .env.example to .env
cp .env.example .env

# Step 7: Generate the application key
php artisan key:generate

# Step 8: Start the Laravel server
php artisan serve
