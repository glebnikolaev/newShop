<?php

namespace App\Http\Controllers\Api\V1\Modules;

use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FeaturedController extends Controller
{
    /**
     * Выводим список избранного
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $products = Product::isActive()->isFeatured()->with('categories', 'options', 'options.parameters', 'images', 'options.parameters.variation')->get();
        return ProductResource::collection($products);
    }
}
