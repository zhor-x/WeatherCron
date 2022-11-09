<?php

namespace App\Services;

use App\Interfaces\WeatherInterface;
use App\Models\Weather;
use Carbon\Carbon;

class WeatherService
{

    public function __construct(private WeatherInterface $weather)
    {
    }

    /**
     * @param  object  $weather
     *
     * @return void
     */
    public function saveWeather(object $weather): void
    {
        $weatherModel = new Weather();
        $weatherModel->name = $weather->name;
        $weatherModel->time = Carbon::now()->format('H:i:s');
        $weatherModel->latitude = $weather->coord->lat;
        $weatherModel->longitude = $weather->coord->lon;
        $weatherModel->temperature = $weather->main->temp;
        $weatherModel->pressure = $weather->main->pressure;
        $weatherModel->humidity = $weather->main->humidity;
        $weatherModel->temp_min = $weather->main->temp_min;
        $weatherModel->temp_max = $weather->main->temp_max;
        $weatherModel->save();
    }


    public function getWeathers()
    {
        return $this->weather->get();
    }
}
