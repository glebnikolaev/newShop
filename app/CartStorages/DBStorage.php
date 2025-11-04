<?php

namespace App\CartStorages;

use App\Models\Basket;
use Darryldecode\Cart\CartCollection;

class DBStorage {

    public function has($key)
    {
        return Basket::find($key);
    }

    public function get($key)
    {
        if($this->has($key))
        {
            return new CartCollection(Basket::find($key)->cart_data);
        }
        else
        {
            return [];
        }
    }

    public function put($key, $value)
    {
        if($row = Basket::find($key))
        {
            // update
            $row->cart_data = $value;
            $row->save();
        }
        else
        {
            Basket::create([
                'id' => $key,
                'cart_data' => $value
            ]);
        }
    }
}
