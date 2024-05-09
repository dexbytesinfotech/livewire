## Livewire Admin Panel

## Lib
- Laravel 9.x
- Livewire 2.x
- Twillo (SMS)
- Firebase (Push Notifications)

# Installation

## Step 1 
1. Project https://github.com/dexbytesinfotech/laravel-api should be pre-installed in your server or machine

## Step 2
1. Run git clone https://github.com/dexbytesinfotech/livewire.git livewire-admin-panel
2. From the projects root run `cp .env.example .env`
3. Configure your `.env` file 
4. Use a same api database (https://github.com/dexbytesinfotech/laravel-api) for the project 
5. From the projects root folder run `composer update`
6. From the projects root folder run `php artisan key:generate`
7. From the projects root folder run `php artisan db:seed`
8. From the projects root folder run `composer dump-autoload`
9. From the projects root folder run `php artisan storage:link`
10. From the projects root folder run (local) `php artisan schedule:work` for server use supervisor
11. From the projects root folder run (local) `php artisan schedule:work` for server use scheduling * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1


### Folder Ownership and Permission
1. Check the permissions on the storage directory: `chmod -R 775 storage`    
1. Check the ownership of the storage directory: : `chown -R www-data:www-data storage`


### Seeds
##### Seeded Roles
  * Unverified
  * Cusotmer
  * Admin
  * Vendor


##### Seeded Users
|Email|Password|Access|
|:------------|:------------|:------------|
|admin@admin.com|admin123| Admin Access|


## Remove public from url
```bash
<IfModule mod_rewrite.c>
	RewriteEngine On
	RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```