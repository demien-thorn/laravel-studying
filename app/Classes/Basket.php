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
    protected mixed $order;

    /**
     * Basket constructor.
     * In its argument, we check if the order is already created (false by default).
     * Then we create a session with key "order" and put it into varible $order.
     *
     * Then if $order is empty and argument is set to true, we create a new data array.
     * If the customer is authorized, we put his id to this data.
     * Then we put currency id from session to this data.
     * Then we create a new Order object with this data and put it into class property order.
     *
     * In the other case, we put orders data from session to the class property order.
     *
     * @param bool $createOrder
     */
    public function __construct(bool $createOrder = false)
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
     * Method gets order data from the class property (based on the construct method).
     *
     * @return mixed - order data
     */
    public function getOrder(): mixed
    {
        return $this->order;
    }

    /**
     * Method cheks wether customers can purchase the product in the amount they added to the basket.
     * Method collect the products in the basket to the collection first.
     * Then it finds each product in the collection in the Sku model and checks the quantity.
     * If quantity in order is more than available - returns false.
     * If not - it substracts ordered quantity from the available and pushes it to the DB.
     *
     * @param bool $updateCount
     * @return bool
     */
    public function countAvailable(bool $updateCount = false): bool
    {
        $skus = collect();
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
     * Method gets customer's data (name, phone, email) in its arguments.
     * If customers want to purchase the products in greater amount, then we have returns false.
     * If everything is OK, we save an order (using Order's method saveOrder()) with date from the arguments.
     * Then we send mail to the customer with order's data.
     *
     * @param $name - customer's name
     * @param $phone - customer's phone
     * @param $email - customer's email
     * @return bool - returns positive or negative result of the function
     */
    public function saveOrder($name, $phone, $email): bool
    {
        if (!$this->countAvailable(updateCount: true)) {
            return false;
        }
        $this->order->saveOrder(name: $name, phone: $phone);
        Mail::to(users: $email)->send(mailable: new OrderCreated(name: $name, order: $this->getOrder()));
        return true;
    }

    /**
     * Method removing a product from the basket.
     *
     * If there is sku in an order we're interacting with, method finds first record from DB (using sku's id)
     * and then checks how much of these in an order;
     * if it's count before interact is less than 2, then removes a product from the basket;
     * if it's 2 or more - just removing one peace of it.
     *
     * @param Sku $sku
     */
    public function removeSku(Sku $sku): void
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
     * Method adding a product to the basket.
     *
     * If there is sku in an order we're interacting with, method finds first record from DB (using sku's id)
     * and then checks how much of these in an order;
     * if sku is already in the order and:
     *     there is more peace in order than available to purchase - returns false;
     *     in other case - adds one more peace to an order;
     * if sku is NOT already in an order:
     *     if the count of sku is 0 - returns false;
     *     in other case - sets quantity of sku in an order as 1 and adds it to an order.
     *
     * @param Sku $sku
     * @return bool
     */
    public function addSku(Sku $sku): bool
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
     * Method gets a coupon (which is an object of a Coupon model) in its argument
     * and associates it with a coupon in the order
     *
     * Usage: BasketController->setCoupon
     *
     * @param Coupon $coupon - gets a coupon when customer indicates it
     */
    public function setCoupon(Coupon $coupon): void
    {
        $this->order->coupon()->associate(model: $coupon);
    }

    /**
     * This method clears the coupon from the basket if it isn't available when adding it by a customer to an order
     *
     * @return void
     */
    public function clearCoupon(): void
    {
        $this->order->coupon()->dissociate();
    }

    /**
     * Makes the same thing as clearCoupon() method, but first check wether the order has a coupon.
     *
     * @return void
     */
    public function removeCoupon(): void
    {
        if ($this->order->hasCoupon()) {
            $this->order->coupon()->dissociate();
        }
    }
}
