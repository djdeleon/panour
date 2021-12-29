<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Resources\OptionResource;

class CategoryController extends Controller
{
    public function __invoke()
    {
        return OptionResource::collection(Category::all());
    }
}
