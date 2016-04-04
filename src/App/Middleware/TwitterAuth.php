<?php
namespace App\Middleware;

use Silex\Application;
use App\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp;

class TwitterAuth
{
    public function run(Request $request, Application $app)
    {
        if (!$app['session']->has('twitter.bearer')) {  
            $bearer = $app['parameters']['twitter']['key'] . ':' . $app['parameters']['twitter']['secret'];
            $bearerCredentials = base64_encode($bearer);

            $client = new GuzzleHttp\Client();
            try {
                $response = $client->post(
                    'https://api.twitter.com/oauth2/token',
                    [
                        'form_params' => ['grant_type' => 'client_credentials'],
                        'headers'     => [
                            'Authorization' => 'Basic ' . $bearerCredentials,
                            'Content-Type'  =>
                                'application/x-www-form-urlencoded;charset=UTF-8'
                        ]
                    ]
                );
            } catch (\Exception $e) {
                throw new Exception($e->getMessage());
            }
            $app['session']->set('twitter.bearer', json_decode($response->getBody(), 1)['access_token']);
        }
    }
}
