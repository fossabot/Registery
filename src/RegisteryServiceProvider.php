<?php

namespace DALTCORE\Registery;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Class PackageServiceProvider
 *
 * @package DALTCORE\Tarpit
 * @see     http://laravel.com/docs/master/packages#service-providers
 * @see     http://laravel.com/docs/master/providers
 */
class RegisteryServiceProvider extends BaseServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @see http://laravel.com/docs/master/providers#deferred-providers
     * @var bool
     */
    protected $defer = false;

    /**
     * Application is booting
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @see http://laravel.com/docs/master/providers#the-boot-method
     * @return void
     */
    public function boot(Router $router)
    {
        //
    }

    /**
     * Loads a path relative to the package base directory
     *
     * @param string $path
     *
     * @return string
     */
    protected function packagePath($path = '')
    {
        return sprintf("%s/../%s", __DIR__, $path);
    }
}
