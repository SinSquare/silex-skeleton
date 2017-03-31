<?php

use Sami\ApiBundle\Entity\Config;
use Silex\Provider\WebProfilerServiceProvider;

require __DIR__.'/app_prod.php';

$app->register(new WebProfilerServiceProvider(), $app['profiler.config']);
