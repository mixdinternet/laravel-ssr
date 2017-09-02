## Server Side Rendering with Laravel + Phantomjs

[![Total Downloads](https://poser.pugx.org/mixdinternet/laravel-ssr/d/total.svg)](https://packagist.org/packages/mixdinternet/laravel-ssr)
[![Latest Stable Version](https://poser.pugx.org/mixdinternet/laravel-ssr/v/stable.svg)](https://packagist.org/packages/mixdinternet/laravel-ssr)
[![License](https://poser.pugx.org/mixdinternet/laravel-ssr/license.svg)](https://packagist.org/packages/mixdinternet/laravel-ssr)

Did someone say Server Side Rendering with Laravel?

This package adds a middleware on your Laravel websites that capture GET requests with `_escaped_fragment_`.
The url will be rendering with [Phantomjs](http://phantomjs.org) and will be cached with [Laravel Cache Drive](https://laravel.com/docs/master/cache)

To make the magic, just add `<meta name="fragment" content="!">` to the `<head>` of all pages that you want to be indexed. (maybe master.blade.php)

More info about [_escaped_fragment_](https://developers.google.com/webmasters/ajax-crawling/docs/specification)

## Dependencies
* [PHP Phantonjs](https://github.com/jonnnnyw/php-phantomjs)

## Installation

You can install this package via composer
```bash
  composer require mixdinternet/laravel-ssr
```

In Laravel 5.5 the service provider will automatically get registered. In older versions of the framework just add the service provider in `config/app.php` file:

```php
'providers' => [
    ...
    Mixdinternet\SSR\Providers\SSRServiceProvider::class,
];
```

You can publish the config file with:

```bash
php artisan vendor:publish --provider="Mixdinternet\SSR\Providers\SSRServiceProvider" --tag="config"
```

## Phantomjs Instalation

Get your copy of Phantomjs [here](http://phantomjs.org/download.html)

Extract the file and put the content of `bin` folder in `storage/app`

It will looks like something like this `storage/app/phantonjs`

Don't worry, you can change this in `config/ssr.php` =)
