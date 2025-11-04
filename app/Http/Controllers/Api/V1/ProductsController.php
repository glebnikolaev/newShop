<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductsController extends Controller
{
    /**
     * Выводим список сохраненных Баннеров
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $products = Product::isActive()->with('categories', 'options', 'options.parameters', 'options.parameters.variation')->get();
        return ProductResource::collection($products);
    }
}
