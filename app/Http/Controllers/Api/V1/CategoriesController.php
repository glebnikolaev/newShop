<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoriesController extends Controller
{
    /**
     * Выводим список сохраненных Категорий
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $categories = Category::isActive()->with('products', 'products.options', 'products.options.parameters', 'products.images', 'products.options.parameters.variation')->get();
        return CategoryResource::collection($categories);
    }
}
