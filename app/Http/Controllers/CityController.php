<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Http\Resources\OptionResource;

class CityController extends Controller
{
    public function __invoke()
    {
        return OptionResource::collection(City::all());
    }
}
