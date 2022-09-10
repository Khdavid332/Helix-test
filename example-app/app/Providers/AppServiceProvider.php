<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;

use App\Interfaces\CoordinatesApi;
use App\Services\WeatherMap;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CoordinatesApi::class, WeatherMap::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Http::macro('weathermap', function (string $url, array $query) {
            return Http::baseUrl(config("services.openweathermap.url"))->get($url, 
                array_merge($query, ['appid' => config("services.openweathermap.key")])
            );
        });
    }
}
