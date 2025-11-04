<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCartRequest;
use App\Http\Resources\CartCollection;
use App\Models\OptionParameter;
use App\Models\Product;
use Darryldecode\Cart\CartCondition;

class CartController extends Controller
{

    /**
     * Получить список корзины
     *
     * @return CartCollection
     */
    public function getCart(): CartCollection
    {
        $cartCollection = \Cart::getContent();

        return new CartCollection($cartCollection);
    }


    /**
     * Добавляем товар в корзину
     *
     * @param AddToCartRequest $request
     * @return CartCollection
     */
    public function addToCart(AddToCartRequest $request): CartCollection
    {
        $productId = $request->post('productId');
        $options = $request->post('options');
        $quantity = $request->post('quantity');

        $cartProduct = $this->prepareCartProduct(['id' => $productId, 'options' => $options, 'quantity' => $quantity]);

        \Cart::add($cartProduct);

        $cartCollection = \Cart::getContent();

        return new CartCollection($cartCollection);
    }

    /**
     * Подготавливаем массив товара для работы с корзиной
     *
     * @param array $requestedProduct
     * @return array
     */
    private function prepareCartProduct(array $requestedProduct) :array
    {
        $product = Product::find($requestedProduct['id']);
        $options = $requestedProduct['options'];
        $quantity = $requestedProduct['quantity'];

        $itemId = $product->id;
        $productPrice = $product->price;
        $optionsParametersIds = array_column($options, 'id') ?? [];
        $optionParameters = OptionParameter::whereIn('id', $optionsParametersIds)->with('variation')->get();

        foreach($optionParameters as $optionParameter) {
            $itemId .= '-'.$optionParameter->variation->id;
            $productPrice += $optionParameter->variation->price;
        }

        return [
            'id' => $itemId,
            'name' => $product->name,
            'price' => $productPrice,
            'quantity' => $quantity,
            'attributes' => $optionParameters
        ];
    }
}
