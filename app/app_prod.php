<?php

use App\ControllerProvider\BaseControllerProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\TwigServiceProvider;
use SinSquare\Cache\DoctrineCacheServiceProvider;

$app->register(new MonologServiceProvider(), $app['monolog.config']);
$app->register(new ServiceControllerServiceProvider());
$app->register(new TwigServiceProvider(), $app['twig.params']);
//for web prfiler mainly, might move to app_dev.php if not needed in prod
$app->register(new HttpFragmentServiceProvider());
$app->register(new DoctrineCacheServiceProvider());

$app->register(new BaseControllerProvider('/'));
