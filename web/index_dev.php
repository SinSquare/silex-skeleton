<?php

use Silex\Application;
use Symfony\Component\Debug\Debug;

$GLOBALS['startTime'] = microtime('true');

// This check prevents access to debug front controllers that are deployed by accident to production servers.
// Feel free to remove this, extend it, or make something more sophisticated.
if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || !in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', 'fe80::1', '::1'))
) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}

$loader = require_once __DIR__.'/../vendor/autoload.php';
\Doctrine\Common\Annotations\AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

Debug::enable();
date_default_timezone_set('UTC');
$app = new Application();

require __DIR__.'/../config/dev.php';
require __DIR__.'/../app/app_dev.php';

$app->run();
