<?php

namespace App\ControllerProvider;

use App\Controller\DefaultController;
use Silex\Application;

class BaseControllerProvider extends AbstractControllerProvider
{
    public function boot(Application $app)
    {
        $app['DefaultController'] = function ($app) {
            return new DefaultController($app);
        };
    }

    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/', 'DefaultController:home')->method('POST|GET');
        $controllers->match('/home', 'DefaultController:home')->method('POST|GET')->bind('default.home');

        return $controllers;
    }
}
