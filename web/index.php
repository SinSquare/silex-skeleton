<?php

use Silex\Application;

ini_set('log_errors', '1');
ini_set('error_log', 'Errors.log.txt');
ini_set('display_errors', '0');

$GLOBALS['startTime'] = microtime('true');

//ini_set('display_errors', 0);

$loader = require_once __DIR__.'/../vendor/autoload.php';
\Doctrine\Common\Annotations\AnnotationRegistry::registerLoader(array($loader, 'loadClass'));
date_default_timezone_set('UTC');

$app = new Application();
require __DIR__.'/../config/prod.php';
require __DIR__.'/../app/app_prod.php';
$app->run();
