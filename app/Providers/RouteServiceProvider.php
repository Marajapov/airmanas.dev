<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = '';

    public function boot(Router $router)
    {
        //

        parent::boot($router);

        $router->model('user', \Model\User\ModelName::class);
        $router->model('menu', \Model\Menu\ModelName::class);
        $router->model('flat', \Model\Flat\ModelName::class);
        $router->model('flat', \Model\Flat\ModelName::class);
        $router->model('district', \Model\District\ModelName::class);
        $router->model('city', \Model\City\ModelName::class);
        $router->model('region', \Model\Region\ModelName::class);
        $router->model('inventory', \Model\Inventory\ModelName::class);
        $router->model('flatInventoryTie', \Model\FlatInventoryTie\ModelName::class);
        $router->model('gallery', \Model\Gallery\ModelName::class);
        $router->model('photos', \Model\Photos\ModelName::class);
        $router->model('hotel', \Model\Hotel\ModelName::class);
        $router->model('pension', \Model\Pension\ModelName::class);
        $router->model('mansion', \Model\Mansion\ModelName::class);

        $this->app['view']->addNamespace('Front', app_path().'/Acme/Http/Front/Views/');
        $this->app['view']->addNamespace('Admin', app_path().'/Acme/Http/Admin/Views/');
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Acme/Http/Front/routes.php');
            require app_path('Acme/Http/Admin/routes.php');
            require app_path('Acme/Http/Api/routes.php');
        });
    }
}
