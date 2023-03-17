<?php

namespace App\Classes;


use App\Mail\OrderCreated;
use App\Models\Order;
use App\Models\Product;
use App\Services\CurrencyConversion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Basket
{
    protected $order;

    /**
     * Basket constructor.
     * @param bool $createOrder
     */
    public function __construct($createOrder = false)
    {
        $order = session(key: 'order');
//        $order->currency_id = CurrencyConversion::getCurrentCurrencyFromSession()->id;
//        session(['order' => $order]);
//        dd($order);

        if (is_null(value: $order) && $createOrder) {
            $data = [];
            if (Auth::check()) {
                $data['user_id'] = Auth::id();
            }
            $data['currency_id'] = CurrencyConversion::getCurrentCurrencyFromSession()->id;

            $this->order = new Order($data);
            session(key: ['order' => $this->order]);
        } else {
            $this->order = $order;
        }
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param false $updateCount
     * @return bool
     */
    public function countAvailable($updateCount = false)
    {
        $products = collect(value: []);
        foreach ($this->order->products as $orderProduct) {
            $product = Product::find($orderProduct->id);
            if ($orderProduct->countInOrder > $product->count) {
                return false;
            }
            if ($updateCount) {
                $product->count -= $orderProduct->countInOrder;
                $products->push(values: $product);
            }
        }

        if ($updateCount) {
            $products->map->save();
        }
        return true;
    }

    /**
     * @param $name - customer's name
     * @param $phone - customer's phone
     * @param $email - customer's email
     * @return bool
     */
    public function saveOrder($name, $phone, $email)
    {
        if (!$this->countAvailable(updateCount: true)) {
            return false;
        }
        $this->order->saveOrder($name, $phone);
        Mail::to($email)->send(new OrderCreated($name, $this->getOrder()));
        return true;
    }

    /**
     * Function removing a product from the basket
     * @param Product $product
     */
    public function removeProduct(Product $product)
    {
        if ($this->order->products->contains($product)) {
            $pivotRow = $this->order->products->where('id', $product->id)->first();
            if ($pivotRow->countInOrder < 2) {
                $this->order->products->pop($product->id);
            } else {
                $pivotRow->countInOrder--;
            }
        }
    }

    /**
     * Function adding a product to the basket
     * @param Product $product
     * @return bool
     */
    public function addProduct(Product $product)
    {
        if ($this->order->products->contains($product)) {
            $pivotRow = $this->order->products->where('id', $product->id)->first();
            if ($pivotRow->countInOrder >= $product->count) {
                return false;
            }
            $pivotRow->countInOrder++;
        } else {
            if ($product->count == 0) {
                return false;
            }
            $product->countInOrder = 1;
            $this->order->products->push($product);
        }

        return true;
    }
}
