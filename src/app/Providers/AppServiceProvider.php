<?php

namespace App\Providers;

use App\Interfaces\WeatherInterface;
use App\Repositories\WeatherRepository;
use App\Services\WeatherApiService;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $defaultOptions = [
            'base_uri' => config('app.weather_api_url'),
            'timeout' => 10,
            'verify' => false,
        ];
        $weatherApiKey = config('app.weather_api_key');
        $this->app->bind(WeatherApiService::class, function ($app) use ($defaultOptions, $weatherApiKey) {
            return new WeatherApiService(new Client($defaultOptions), $weatherApiKey);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(WeatherInterface::class, WeatherRepository::class);
    }
}
