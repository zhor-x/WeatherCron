<?php

namespace App\Repositories;

use App\Interfaces\WeatherInterface;
use App\Models\Weather;

class WeatherRepository implements WeatherInterface
{

    /**
     * @param  \App\Models\Weather  $weather
     */
    public function __construct(private Weather $weather)
    {
    }

    /**
     * @return object
     */
    public function get(): object
    {
        return $this->weather->get();
    }
}
