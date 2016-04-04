<?php
namespace App\Controller;

use Silex\Application;
use GuzzleHttp;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class HistogramController
{
    public function histogram(Request $request, Application $app, $username)
    {
        $twitterKey = $app['session']->get('twitter.bearer');

        $tweetsPerHour = [];

        $currentMaxId = $maxId = 0;
        do {

            $tweets = $this->getTweets($twitterKey, $username, 200, $currentMaxId ?: '');

            foreach ($tweets as $tweet) {
                $hour = $this->getTweetHour($tweet['created_at'], $tweet['user']['timezone']);

                if (empty($tweetsPerHour[$hour])) {
                    $tweetsPerHour[$hour] = 0;
                }

                $tweetsPerHour[$hour]++;
                $query['max_id'] = $tweet['id'];
            }


        } while ($maxId != $currentMaxId);

        return new JsonResponse($tweetsPerHour);
    }

    protected function getTweets($apiKey, $username, $count = 10, $maxId = null)
    {
        $client = new GuzzleHttp\Client();

        $response = $client->get(
            'https://api.twitter.com/1.1/statuses/user_timeline.json',
            [
                'query'   => [
                    'screen_name' => $username,
                    'count'       => $count,
                    'maxId'       => $maxId
                ],
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey
                ]
            ]
        );

        return json_decode($response->getBody(), true);
    }

    protected function getTweetHour($tweetTime, $timezone) {
        $createAt = new DateTime($tweetTime, $timezone);
        return $createAt->format('H');
    }

}
