<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CategoryController;

Route::get('/cities', CityController::class);

Route::get('/categories', CategoryController::class);
