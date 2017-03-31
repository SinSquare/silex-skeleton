<?php

// include the prod configuration
require __DIR__.'/prod.php';

$app['debug'] = true;
$app['alwaysShowProfilerToolbar'] = true;
$app['showExecutionTime'] = true;

$app['db.options'] = array(
        'driver' => 'pdo_pgsql',
        'host' => 'localhost',
        'dbname' => 'emailvalidation',
        'user' => 'emailvalidation_user',
        'password' => 'qwertz',
    );

$app['monolog.config'] = array(
    'monolog.logfile' => __DIR__.'/../var/logs/silex_dev.log',
    'monolog.level' => 'DEBUG',
);

$app['profiler.config'] = array('profiler.cache_dir' => __DIR__.'/../var/cache/profiler');

$app['doctrine.cache.options'] = array(
    'aliases' => array(
        'phpfile_cache' => 'phpfile_cache',
    ),
    'providers' => array(
        'phpfile_cache' => array(
            'type' => 'phpfile',
            'namespace' => 'frontend_cache_ns2',
            'extension' => '.cache',
            'directory' => __DIR__.'/../var/cache/doctrine_cache',
        ),
    ),
);

$app['emailcheck_disable_rate_limit'] = true;

//disable twig cache
$twig = $app['twig.params'];
$twig['twig.options'] = array();
$app['twig.params'] = $twig;
