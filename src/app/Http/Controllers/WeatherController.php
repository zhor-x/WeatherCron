<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;

class WeatherController extends Controller
{

    /**
     * @param  \App\Services\WeatherService  $weatherService
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(WeatherService $weatherService): \Illuminate\Http\JsonResponse
    {
        $weathers = $weatherService->getWeathers();
        return response()->json($weathers);
    }
}

