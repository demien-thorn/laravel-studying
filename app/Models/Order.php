<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    /**
     * Contains an array of the fields which are required to fill.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'currency_id',
        'sum',
        'coupon_id',
    ];

    /**
     * Method creates the relation between order and Sku class
     * which is responsible for the Sku functional in the orders.
     * The relation is created for columns 'count' and 'price' with timestamps.
     *
     * @return BelongsToMany
     */
    public function skus(): BelongsToMany
    {
        return $this->belongsToMany(related: Sku::class)->withPivot(columns: ['count', 'price'])->withTimestamps();
    }

    /**
     * Method creates the relation between order and Currency class
     * which is responsible for the currency functional in the orders.
     *
     * @return BelongsTo
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(related: Currency::class);
    }

    /**
     * Method creates the relation between order and Coupon class
     * which is responsible for the coupon functional in the orders.
     *
     * @return BelongsTo
     */
    public function coupon(): BelongsTo
    {
        return $this->belongsTo(related: Coupon::class);
    }

    /**
     * Method gets the status of an order from DB.
     *
     * @param $query
     * @return mixed
     */
    public function scopeActive($query): mixed
    {
        return $query->where('status', 1);
    }

    /**
     * Method takes each product in an order in the cycle and then summs their price in order to get the total sum.
     * Method is doing it using Sku's method getPriceForCount().
     *
     * @return float|int - total price of the order
     */
    public function calculateFullSum(): float|int
    {
        $sum = 0;
        foreach ($this->skus()->withTrashed()->get() as $sku) {
            $sum += $sku->getPriceForCount();
        }
        return $sum;
    }

    /**
     * Method takes each product in an order and calculates its total price first.
     * Then it checks if an order has a coupon.
     * If so, it calculates the price with coupon.
     * Then returns the final order price.
     *
     * @param bool $withCoupon - check wether an order has a coupon
     * @return float|int - final order price
     */
    public function getFullSum(bool $withCoupon = true): float|int
    {
        $sum = 0;

        foreach ($this->skus as $sku) {
            $sum += $sku->price * $sku->countInOrder;
        }

        if ($withCoupon && $this->hasCoupon()) {
            $sum = $this->coupon->applyCost($sum, $this->currency);
        }

        return $sum;
    }

    /**
     * Method saves an order to DB.
     * It gets customer's name and phone from the form, assigns order's status as active
     * and gets a full sum of the order.
     * Then for each product in an order it assigns count and price for DB.
     * Then it clears the current order from the session and returns true.
     *
     * @param $name
     * @param $phone
     * @return bool
     */
    public function saveOrder($name, $phone): bool
    {
        $this->name   = $name;
        $this->phone  = $phone;
        $this->status = 1;
        $this->sum    = $this->getFullSum();

        $skus = $this->skus;
        $this->save();

        foreach ($skus as $skuInOrder) {
            $this->skus()->attach(id: $skuInOrder, attributes: [
                'count' => $skuInOrder->countInOrder,
                'price' => $skuInOrder->price,
            ]);
        }

        session()->forget(keys: 'order');
        return true;
    }

    /**
     * Method checks whether the coupon has been already added to an order or not.
     *
     * @return mixed
     */
    public function hasCoupon(): mixed
    {
        return $this->coupon;
    }
}
