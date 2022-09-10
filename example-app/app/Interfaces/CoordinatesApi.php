<?php
namespace App\Interfaces;

interface CoordinatesApi 
{
    /**
     * Get coordinates of given place.
     * 
     * @param string $location @example "Yerevan"
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     * @param array{"lat": float, "lon": float}
     */
    public function coordinatesOf(string $location): ?array;
}