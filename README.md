# dexbytes-ecom


1. From the projects root folder run `composer update`
2. From the projects root folder run `php artisan key:generate`
3. From the projects root folder run `php artisan migrate`
4. From the projects root folder run `composer dump-autoload`
5. From the projects root folder run `php artisan db:seed`
6. From the projects root folder run `php artisan storage:link`
7.  From the projects root folder run (local) `php artisan schedule:work`

### Seeds
##### Seeded Roles
  * Unverified
  * Cusotmer
  * Admin
  * Vendor
  * Super Admin
  * Driver

##### Seeded Users

|Email|Password|Access|
|:------------|:------------|:------------|
|admin@admin.com|admin123|Super Admin Access|

##### Update swagger
`php artisan l5-swagger:generate`

## Included Filters (as string literals)

| Filter class | Usage |
| -------------| ------------- |
| 'capitalize' | Capitalizes the first character of each word |
| 'email' | Sanitizes email |
| 'sanitize' | Sanitizes text generically |
| 'encode' | URL Encodes text |
| 'number' | Removes all non-numerical characters |
| 'strip' | Removes HTML and PHP tags, keeps what you want |
| 'lowercase' | Converts to lowercase |
| 'uppercase' | Converts to uppercase |
| 'trim' | Trim leading and trailing white space |
| 'date' | Format into a specified Carbon date string see [Carbon docs](https://carbon.nesbot.com/docs/#api-formatting)  |

## Remove public from url
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
