<?php

// configure your app for the production environment

$app['db.options'] = array(
        'driver' => 'pdo_pgsql',
        'host' => 'localhost',
        'dbname' => 'onlineemail',
        'user' => 'onlineemail_php',
        'password' => 'd5be468529f6431c5e674e5e0910f62c',
    );

$app['monolog.config'] = array(
    'monolog.logfile' => __DIR__.'/../var/logs/silex_prod.log',
    'monolog.level' => 'ERROR',
);

$app['doctrine.orm.options'] = array(
    'orm.proxies_dir' => __DIR__.'/../var/cache/doctrine/orm/Proxies',
    'orm.proxies_namespace' => 'Proxies',
    'orm.auto_generate_proxies' => false,
    'orm.em.options' => array(
        'mappings' => array(
            array(
                'type' => 'annotation',
                'namespace' => 'EmailValidation\\ApiBundle\\Entity',
                'alias' => 'EmailValidationApiBundle',
                'path' => __DIR__.'/../src/EmailValidation/ApiBundle/Entity',
                'use_simple_annotation_reader' => false,
            ),
        ),
    ),
    'orm.default_cache' => array(
            'driver' => 'filesystem',
            'namespace' => 'frontend_orm_cache_ns',
            'extension' => 'cache',
            'directory' => __DIR__.'/../var/cache/doctrine_orm',
    ),
);

$app['doctrine.cache.options'] = array(
    'aliases' => array(
        'default_cache' => 'default_cache',
    ),
    'providers' => array(
        'default_cache' => array(
            'type' => 'phpfile',
            'namespace' => 'frontend_cache_ns',
            'extension' => 'cache',
            'directory' => __DIR__.'/../var/cache/doctrine_cache',
        ),
    ),
);

$app['app.username_password_authenticator'] = function ($app) {
    return new App\Security\UsernamePasswordAuthenticator($app['security.encoder_factory'], $app['doctrine.orm.em']);
};

$app['csecurity.user_entry_point'] = function ($app) {
    return new App\Security\UsernamePasswordAuthenticator($app['security.encoder_factory'], $app['doctrine.orm.em']);
};

$app['security.options'] = array(
    'security.encoders' => array(
        'EmailValidation\ApiBundle\Entity\User' => array(
            'algorithm' => 'sha256',
            'encode_as_base64' => false,
            'iterations' => 123,
        ),
    ),
    'security.firewalls' => array(
        'default' => array(
            'pattern' => '^/',
            'anonymous' => true,
            'form_custom' => array(
                'login_path' => '/login',
                'check_path' => '/login',
                'default_target_path' => '/user/dashboard',
            ),
            'logout' => array(
                'logout_path' => '/logout',
                'target' => '/',
                'invalidate_session' => true,
                'delete_cookies' => array(
                    'rememberme',
                ),
            ),
            'remember_me' => array(
                'name' => 'rememberme',
                'key' => 'a7646ec222c23833fcdc33fed6bf8e4a92ed7fc2',
                'lifetime' => 604800, // 1 week in seconds
                'path' => '/',
            ),
            'users' => function () use ($app) {
                return new EmailValidation\ApiBundle\Entity\UserProvider($app['doctrine.orm.em']);
            },
        ),
        'dev' => array(
            'pattern' => '^/(_(profiler|wdt)|css|images|js)/',
            'security' => false,
        ),
    ),
    'security.access_rules' => array(
        array('^/login$', 'IS_AUTHENTICATED_ANONYMOUSLY'),
        array('^/user/admin/.+$', 'ROLE_ADMIN'),
        array('^/user/.+$', 'ROLE_USER'),
    ),
    'security.role_hierarchy' => array(
        'ROLE_ADMIN' => array('ROLE_USER'),
        'ROLE_USER' => array(),
        'ROLE_DEVELOPER' => array('ROLE_USER'),
    ),
);

$app['swiftmailer.options'] = array(
    'host' => 'mail.onlineemailvalidation.com',
    'port' => 25,
    'username' => 'noreply@onlineemailvalidation.com',
    'password' => 'dV91XzpJ2MQFSPu6dJt1',
    'auth_mode' => 'plain',
);

$app['mailer_email'] = 'noreply@onlineemailvalidation.com';
$app['mailer_name'] = 'OnlineEmailValidation.com';

$app['twig.params'] = array(
    'twig.path' => array(__DIR__.'/../src/Template'),
    'twig.options' => array('cache' => __DIR__.'/../var/cache/twig'),
);

$app['showExecutionTime'] = true;

$app['frontendapi.allowedmethods'] = 'GET|POST';

$app['support.email'] = 'support@onlineemailvalidation.com';
