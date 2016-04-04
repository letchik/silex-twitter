<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Controller\HelloController;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;


$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Igorw\Silex\ConfigServiceProvider(__DIR__ . '/../config/config.yml'));

$app->before('App\Middleware\TwitterAuth::run');

$app->get(
    '/',
    function () {
        return new Response('Try /hello/:name');
    }
);

$app->get('/hello/{username}', 'App\Controller\HelloController::hello');

$app->get(
    '/histogram/{username}',
    'App\Controller\HistogramController::histogram'
);

$app->run();
