## Installation

1. Clone the repo and `cd` into it
2. `composer install`
3. Rename or copy `.env.example` file to `.env` or run this script `php -r "file_exists('.env') || copy('.env.example', '.env');"`
4. `php artisan key:generate`
5. Setup a database and add your database credentials in your `.env` file
6. `php artisan migrate` (`php artisan migrate --seed` if you want to seed example data)
7. `npm install`
8. `npm run dev`
9. `php artisan serve`
10. Visit `localhost:8000` in your browser

## Accounts
### Admin

> Email: admin@example.com
> Password: 123123123
