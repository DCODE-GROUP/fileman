## Installation

Install the package via composer:

```bash
composer require dcodegroup/fileman
```

Publish the migrations:

```php
php artisan vendor:publish --provider="DcodeGroup\Fileman\FilemanServiceProvider" --tag="migrations"
```

Publish the vendor front-end resources:

```php
php artisan vendor:publish --provider="DcodeGroup\Fileman\FilemanServiceProvider" --tag="styles"
```

Add the package routes to your web.php file:
```php
\DcodeGroup\Fileman\Routes::get();
```

Fileman will connect to the applications S3 bucket automatically. You'll need to have fileman index the bucket first before it can be used. To index the S3 bucket run:
```php
php artisan fileman:import
```