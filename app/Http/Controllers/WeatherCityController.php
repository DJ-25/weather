<?php

namespace App\Http\Controllers;

use App\Models\WeatherCity;
use Illuminate\Support\Arr;
use App\Extensions\WeatherAPI;

class WeatherCityController extends Controller
{
    public function show($id)
    {
        $city = WeatherCity::find($id);

        $weatherApi = new WeatherAPI;
        $apiData = $weatherApi->getLatLonByCityName($city->lat, $city->lon);

        $initDate = Arr::get($apiData, 'init');
        $dataseries = collect(Arr::get($apiData, 'dataseries'));

        $dataseries->transform(function ($item) use ($initDate) {
            $hours  = Arr::get($item, 'timepoint');
            $temp  = Arr::get($item, 'temp2m');
            $wind  = Arr::get($item, 'wind10m.speed');

            return [
                'datetime' => \Carbon\Carbon::createFromFormat('YmdH', $initDate)->addHours($hours)->format('Y-m-d H:i:s'),
                'temp' => $temp,
                'wind' => $wind
            ];
        });

        return view('weather.show', compact('dataseries', 'city'));
    }

    public function list()
    {
        $cities = WeatherCity::all();

        $cities = $cities->each(function ($item) {
            $item->number = rand(1, 10);
        });

        $cities = $cities->filter(function ($item) {
            return $item->number >3;
        });

        return view('weather.list');
    }
}
