<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;

class MainController
{
    public function main() {
        return new Response('Try /hello/:name');
    }
}
