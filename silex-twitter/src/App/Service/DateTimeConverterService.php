<?php

namespace App\Service;

use Silex\Application;
use Silex\ServiceProviderInterface;
use DateTime, DateInterval;

/**
 * Service that can convert UTC ISO Date to ISO Date with timezone and return hour of the day according to this date 
 *
 * Class DateTimeConverterService
 * @package App\Service
 */
class DateTimeConverterService implements ServiceProviderInterface
{
    /**
     * @var Application $app
     */
    private $app;

    /**
     * @param Application $app
     */
    public function register(Application $app)
    {
        $this->app = $app;

        $app['datetime.hour'] = $app->protect(
            function ($utcTime, $offset) {
                return $this->convert($utcTime, $offset);
            }
        );
    }

    /**
     * @param string $utcTime
     * @param int $offset
     * @return string
     */
    protected function convert($utcTime, $offset)
    {
        $createdAt = new DateTime($utcTime);
        $interval = new DateInterval('PT' . abs($offset) . 'S');

        if ($offset < 0) {
            $interval->invert = 1;
        }
        $createdAt->add($interval);

        return $createdAt->format('G');
    }

    /**
     * @param Application $app
     */
    public function boot(Application $app)
    {
        // do nothing
    }
}
