# ami-hook

Webhook API for Asterisk AMI.

## Install

Via Composer

``` bash
$ composer require enniel/ami-hook
```

Add the service provider to your `config/app.php`:

```php
...
'providers' => [
    ...
    Enniel\AmiHook\AmiHookServiceProvider::class,
],
...
```

Publish and run the migration to create the `webhooks` table that will hold all installed webhooks.

```sh
php artisan vendor:publish --provider="Mpociot\CaptainHook\CaptainHookServiceProvider"

php artisan migrate
```

For more information about webhooks see [mpociot/captainhook][link-captain-webhook-package].

Next, you should call the `AmiHook::routes` method within the boot method of your `RouteServiceProvider`. This method will register webhook routes:

```php

<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Enniel\AmiHook\AmiHook;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/web.php');
        });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        AmiHook::routes(null, [
            'middleware' => 'auth:api',
            'prefix' => 'api',
        ]);

        Route::group([
            'middleware' => 'api',
            'namespace' => $this->namespace,
            'prefix' => 'api',
        ], function ($router) {
            require base_path('routes/api.php');
        });
    }
}

```
## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email razumov.evgeni@gmail.com instead of using the issue tracker.

## Credits

- [Evgeny Razumov][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/enniel/ami-hook.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/enniel/ami-hook/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/enniel/ami-hook.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/enniel/ami-hook.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/enniel/ami-hook.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/enniel/ami-hook
[link-travis]: https://travis-ci.org/enniel/ami-hook
[link-scrutinizer]: https://scrutinizer-ci.com/g/enniel/ami-hook/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/enniel/ami-hook
[link-downloads]: https://packagist.org/packages/enniel/ami-hook
[link-author]: https://github.com/enniel
[link-contributors]: ../../contributors
[link-captain-webhook-package]: https://github.com/mpociot/captainhook
