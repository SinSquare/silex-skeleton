<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function home(Request $request)
    {
        $html = $this->app['twig']->render(
            'Default/home.html.twig',
            array()
        );

        return $html;

        return new Response('Some data from home');
    }
}
