<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class MainController
 * @package App\Controller
 */
class MainController
{
    /**
     * @return Response
     */
    public function main()
    {
        return new Response('Try /hello/:name');
    }
}
