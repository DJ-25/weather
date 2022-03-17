<?php

namespace App\Extensions;

class WeatherAPI
{
    public function getLatLonByCityName($lat, $lon)
    {
        $apiUrl = 'https://www.7timer.info/bin/astro.php?lon='.$lon.'&lat='.$lat.'&ac=0&unit=metric&output=json&tzshift=0';

        $cacheKey = 'api_weather_'.$lat.'_'.$lon;
        return \Cache::remember($cacheKey, 3600, function () use ($apiUrl) {
            return json_decode(file_get_contents($apiUrl), true);
        });
    }
}