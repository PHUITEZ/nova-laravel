```bash
composer install
npm install
php artisan migrate:fresh --seed
mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views storage/framework/testing storage/app/public storage/debugbar
composer run dev
```
