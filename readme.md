## Versions

* Legacy branch is for the pre php 8 and pre laravel 8 applications  - maintain 1.4.x on packagist
* master is for php 8+ and laravel 8 plus. use version 2.0.x on packagist


## Installation

Install the package via composer:

```bash
composer require dcodegroup/fileman
```

```bash
npm install @vitejs/plugin-vue
npm install vue
npm install vite-svg-loader
npm install lodash
npm install vite-plugin-laravel-translations
npm install vue-i18n
npm install vue3-click-away
```


Publish the migrations:

```bash
php artisan vendor:publish --provider="DcodeGroup\Fileman\FilemanServiceProvider" --tag="migrations"
```

Publish the vendor front-end resources:

```php
php artisan vendor:publish --provider="DcodeGroup\Fileman\FilemanServiceProvider" --tag="styles"
```

Add the following to your providers.php file:
```php
DcodeGroup\Fileman\FilemanServiceProvider::class,

return [
    App\Providers\AppServiceProvider::class,
    \DcodeGroup\Fileman\FileManServiceProvider::class,
];
```

Add the package routes to your web.php file:

```php
in web.php
\DcodeGroup\Fileman\Routes\Web::get();

in api.php
\DcodeGroup\Fileman\Routes\Api::get();
```

JS
Add the following alias to vite.config.js

```js

resolve: {
  alias: {
      "@fileman": path.resolve(__dirname, "./vendor/dcodegroup/fileman"),

```

Seem to need this in tailwind.config.js, Update the module exports under content:
```js
content: [
  ...
    "./vendor/dcodegroup/**/*.{blade.php,vue,js,ts}",
  ...
],
```

in the app.js file or other file where you are registering your vue components add the following:
```js
import { registerFileman } from "@fileman/src/resources/js";
registerFileman(app);
```



Fileman will connect to the applications S3 bucket automatically. You'll need to have fileman index the bucket first before it can be used. To index the S3 bucket run:
```php
php artisan fileman:import
```
