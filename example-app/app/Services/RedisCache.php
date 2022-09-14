<?php

namespace App\Services;

use App\Interfaces\Cache;
use Illuminate\Support\Facades\Redis;

class RedisCache implements Cache
{
    public function set(string $key, mixed $value): void 
    {
        Redis::set($key, json_encode($value));
    }

    public function get(string $key): mixed 
    {
        $value = Redis::get($key);

        return $value ? json_decode($value, true) : null;
    }
}