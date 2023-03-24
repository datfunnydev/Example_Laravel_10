php artisan optimize:clear
php artisan optimize
php artisan view:cache
php artisan event:cache
rm -Rf public/storage
php artisan storage:link
./vendor/bin/pint
