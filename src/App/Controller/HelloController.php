<?php
namespace App\Controller;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HelloController
{
    public function hello(Request $request, Application $app, $username) {
        return new Response('Hello ' . $app->escape($username));
    }
}
