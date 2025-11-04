<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CartCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'data' => $this->collection,
            'count' => \Cart::getTotalQuantity(),
            'subTotal' => \Cart::getSubTotal(),
            'total' => \Cart::getTotal(),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
