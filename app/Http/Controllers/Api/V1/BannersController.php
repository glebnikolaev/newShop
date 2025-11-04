<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\BannerResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Controllers\Controller;
use App\Models\Banner;

class BannersController extends Controller
{
    /**
     * Выводим список сохраненных Баннеров
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $banners = Banner::isActive()->orderBy('sort_order', 'asc')->get();
        return BannerResource::collection($banners);
    }
}
