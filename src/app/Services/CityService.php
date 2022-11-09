<?php

namespace App\Services;

use App\Models\City;

/**
 *
 */
class CityService
{

    /**
     * I wrote two use cases, one in the repository and one in the service, to show that I use both
     *
     * @param  \App\Models\City  $city
     */
    public function __construct(private City $city)
    {
    }

    /**
     * @return object
     */
    public function getCities(): object
    {
        return $this->city->get();
    }
}
