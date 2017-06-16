# Laravel MultiAuthRole



## Install

Via Composer

``` bash
$ composer require kopin88/multirole
```

Next, add your new Provider to the providers array of config/app.php:

```bash
'providers' => [


  `learn88\multirole\multiroleServiceProvider::class,`


],  

```
Next, add your `new Kernel` to the `HTTP kernel`  **$routeMiddleware**

```bash
protected $routeMiddleware = [


  `'roles' => \learn88\multirole\Http\Middleware\CheckRole::class,`


],  

```

## Usage

``` php
  php artisan kopin88:multirole

  composer dump-autoload

  php artisan migrate

  php artisan db:seed

```
###### Default
> username : admin@learn88.dev
> password : password


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
