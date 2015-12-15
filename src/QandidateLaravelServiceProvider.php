<?php namespace Msamec\QandidateLaravel;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class QandidateLaravelServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

     /**
      * Perform post-registration booting of services.
      */
     public function boot()
     {
        if (is_dir(base_path().'/resources/views/packages/msamec/qandidate')) {
            $this->loadViewsFrom(
                base_path() . '/resources/views/packages/msamec/qandidate',
                'qandidate'
            );
        } else {
            $this->loadViewsFrom(
                __DIR__ . '/views/qandidate',
                'qandidate'
            );
        }
        $this->mergeConfigFrom(
            __DIR__.'/config/qandidate.php',
            'qandidate'
        );

        if(config('qandidate.customCRUD')){
            $this->setupRoutes($this->app->router);
        }

        $this->publishes([
            __DIR__.'/database/migrations/' => database_path(
                'migrations'
            )
        ], 'migrations');

        $this->publishes([
             __DIR__.'/config/qandidate.php' => config_path(
                'qandidate.php'
            )
        ], 'config');

        $this->publishes([
            __DIR__.'/views/qandidate' => base_path(
                'resources/views/packages/msamec/qandidate'
            )
        ], 'views');
     }

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function setupRoutes(Router $router)
    {
        $router->group([
            'namespace' => 'Msamec\QandidateLaravel\Http\Controllers'],
            function ($router) {
                require __DIR__.'/Http/routes.php';
            }
        );
    }

    /**
     * Register any package services.
     */
    public function register()
    {
        $this->app->bind('qandidate', function ($app) {
            return new Qandidate($app);
        });
    }
}
