laravel-mailee
==============

[Mailee](http://mailee.me) API for Laravel

## Quick start

### Required setup
In the `require` key of `composer.json` file add the following

    "bubb/mailee": "dev-master"

Run the composer update command

    $ composer update

In your `config/app.php` add `'BUBB\Mailee\ServiceProvider'` to the end of the `$providers` array

    'providers' => array(

        'Illuminate\Foundation\Providers\ArtisanServiceProvider',
        'Illuminate\Auth\AuthServiceProvider',
        ...
        'BUBB\Mailee\ServiceProvider',

    ),

At the end of `config/app.php` add `'Mailee'    => 'BUBB\Mailee\Facade'` to the `$aliases` array

    'aliases' => array(

        'App'        => 'Illuminate\Support\Facades\App',
        'Artisan'    => 'Illuminate\Support\Facades\Artisan',
        ...
        'Mailee'   	 => 'BUBB\Mailee\Facade',

    ),

#### Publish your config

Publish the config files:

    $ php artisan config:publish bubb/mailee

## Usage

### Create a contact

	<?php

	Mailee::createContact(['name' => 'Lucas Colette', 'email' => 'lucas@bubb.com.br']);


### Attach a contact to list

	<?php

	Mailee::createContact(['name' => 'Lucas Colette', 'email' => 'lucas@bubb.com.br'])->attachToList('MyList');