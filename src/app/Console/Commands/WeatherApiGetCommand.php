<?php

namespace App\Console\Commands;

use App\Services\CityService;
use App\Services\WeatherApiService;
use App\Services\WeatherService;
use Exception;
use Illuminate\Console\Command;


/**
 *
 */
class WeatherApiGetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:weathers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get Weather';


    /**
     * @param  \App\Services\WeatherApiService  $weatherApiService
     * @param  \App\Services\CityService  $cityService
     */
    public function __construct(
        private WeatherApiService $weatherApiService,
        private WeatherService $weatherService,
        private CityService $cityService
    ) {
        parent::__construct();
    }


    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle()
    {
        try {
            $cities = $this->getCities();
            $weathers = $this->getWeathers($cities);
            $this->setWeather($weathers);
        } catch (Exception $e) {
            $this->error($e->getMessage());
            print "I CAUGHT IT!";
        }
    }


    /**
     * @param  object  $cities
     *
     * @return object
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getWeathers(object $cities): object
    {
        $weathers = [];
        foreach ($cities as $city) {
            $weathers[] = $this->weatherApiService->getWeather(
                latitude: $city->latitude,
                longitude: $city->longitude
            );
        }

        return collect($weathers);
    }

    /**
     * @return object
     */
    private function getCities(): object
    {
        return $this->cityService->getCities();
    }

    private function setWeather(object $weathers)
    {
        $weathers->each(function ($weather) {
            $this->weatherService->saveWeather($weather);
        });
    }
}
