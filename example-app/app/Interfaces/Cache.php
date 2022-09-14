<?php
namespace App\Interfaces;
interface Cache
{
    /**
     * 
     * Set the value to cashe.
     * 
     * @param string $key
     * @param mixed $value
     * 
     * @return void
     */
    public function set(string $key, mixed $value): void;

    /**
     * Get value from cashe.
     * 
     * @param string $key
     * 
     * @return mixed
     */
    public function get(string $key): mixed;
}