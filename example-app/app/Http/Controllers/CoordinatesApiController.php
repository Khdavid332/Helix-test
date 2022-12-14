<?php
namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;

use App\Interfaces\CoordinatesApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\LocationCoordinatesRequest;
use App\Interfaces\Cache;

class CoordinatesApiController extends Controller 
{
    public function __construct(protected CoordinatesApi $api, protected Cache $cache){}

    /**
     * Get coordinates of given city.
     * 
     * @api
     * 
     * @param \App\Http\Requests\LocationCoordinatesRequest $request
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     * @return \Illuminate\Http\Response 
     */ 
    public function getCoordinates(LocationCoordinatesRequest $request): Response
    {
        $location = $request->get("query");
        $cashed = $this->cache->get($location);

        if (!$cashed) {
            $coordinates = $this->api->coordinatesOf($location);
            $this->cache->set($location, $coordinates);
        } 

        return response([
            "result" => $cashed ?? $coordinates 
        ], 200);
    }  
}