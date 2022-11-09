<?php

namespace App\Services;

use GuzzleHttp\Client;

class WeatherApiService
{

    private const URI = 'weather';
    private const QUERY = 'query';

    /**
     * @param  \GuzzleHttp\Client  $client
     * @param $weatherApiKey
     */
    public function __construct(private Client $client, private $weatherApiKey)
    {
    }


    /**
     * @param $latitude
     * @param $longitude
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getWeather($latitude, $longitude): object
    {
        $res = $this->client->get(
            self::URI,
            [self::QUERY => "lat=$latitude&lon=$longitude&appid=$this->weatherApiKey&units=metric"]
        );
        return json_decode($res->getBody());
    }
}
