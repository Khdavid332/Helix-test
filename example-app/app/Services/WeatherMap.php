<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Exceptions\HttpResponseException;

use App\Interfaces\CoordinatesApi;

class WeatherMap implements CoordinatesApi
{
    public function coordinatesOf(string $location): array
    {
        $response = Http::weathermap(config("services.openweathermap.geocoding-api"), [
            "q" => $location, 
            "limit" => 1
        ]);
    
        if ($response->failed()) {
            throw new HttpResponseException(response(["result" => null], $response->status()));
        }
        
        return $response->collect(0)
            ->only(["lon", "lat"])
            ->toArray();
    }
}