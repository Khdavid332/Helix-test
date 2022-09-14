<?php
namespace App\Providers;

use App\Interfaces\Cache;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;

use App\Interfaces\CoordinatesApi;
use App\Services\RedisCache;
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
        $this->app->bind(Cache::class, RedisCache::class);
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
