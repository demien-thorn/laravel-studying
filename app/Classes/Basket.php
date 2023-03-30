<?php

namespace App\Classes;


use App\Mail\OrderCreated;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Sku;
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

        if (is_null(value: $order) && $createOrder) {
            $data = [];
            if (Auth::check()) {
                $data['user_id'] = Auth::id();
            }
            $data['currency_id'] = CurrencyConversion::getCurrentCurrencyFromSession()->id;

            $this->order = new Order(attributes: $data);
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
        $skus = collect(value: []);
        foreach ($this->order->skus as $orderSku) {
            $sku = Sku::find($orderSku->id);
            if ($orderSku->countInOrder > $sku->count) {
                return false;
            }
            if ($updateCount) {
                $sku->count -= $orderSku->countInOrder;
                $skus->push(values: $sku);
            }
        }

        if ($updateCount) {
            $skus->map->save();
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
        $this->order->saveOrder(name: $name, phone: $phone);
        Mail::to(users: $email)->send(mailable: new OrderCreated(name: $name, order: $this->getOrder()));
        return true;
    }

    /**
     * Function removing a product from the basket
     * @param Sku $sku
     */
    public function removeSku(Sku $sku)
    {
        if ($this->order->skus->contains($sku)) {
            $pivotRow = $this->order->skus->where('id', $sku->id)->first();
            if ($pivotRow->countInOrder < 2) {
                $this->order->skus->pop($sku->id);
            } else {
                $pivotRow->countInOrder--;
            }
        }
    }

    /**
     * Function adding a product to the basket
     * @param Sku $sku
     * @return bool
     */
    public function addSku(Sku $sku)
    {
        if ($this->order->skus->contains($sku)) {
            $pivotRow = $this->order->skus->where('id', $sku->id)->first();
            if ($pivotRow->countInOrder >= $sku->count) {
                return false;
            }
            $pivotRow->countInOrder++;
        } else {
            if ($sku->count == 0) {
                return false;
            }
            $sku->countInOrder = 1;
            $this->order->skus->push($sku);
        }

        return true;
    }

    /**
     * Method gets a coupon (which is an object of a Coupon model) in it's argument
     * and associates it with coupon in the order
     *
     * Usage: BasketController->setCoupon
     *
     * @param Coupon $coupon - gets a coupon when customer indicates it
     */
    public function setCoupon(Coupon $coupon)
    {
        $this->order->coupon()->associate(model: $coupon);
    }

    /**
     * This method clears the coupon from the basket if it is't available when adding it by a customer to an order
     */
    public function clearCoupon()
    {
        $this->order->coupon()->dissociate();
    }
}
