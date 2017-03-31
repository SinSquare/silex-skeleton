<?php

namespace App\ControllerProvider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Api\BootableProviderInterface;
use Silex\Api\ControllerProviderInterface;
use Silex\Api\EventListenerProviderInterface;
use Silex\Application;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

abstract class AbstractControllerProvider implements BootableProviderInterface, ControllerProviderInterface, EventListenerProviderInterface, ServiceProviderInterface
{
    /*
    1:construct
    2:boot
    3:register
    4:connect
    5:subscribe
    */

    protected $routePrefix;
    protected $app;

    public function __construct($routePrefix)
    {
        $this->routePrefix = $routePrefix;
    }

    public function subscribe(Container $app, EventDispatcherInterface $dispatcher)
    {
        //subscribe to events if you need
    }

    public function register(Container $app)
    {
        $app->mount($this->routePrefix, $this);
        $this->app = $app;
    }

    abstract public function connect(Application $app);

    abstract public function boot(Application $app);
}
