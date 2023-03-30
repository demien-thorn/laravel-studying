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
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'currency_id',
        'sum',
        'coupon_id',
    ];

    /**
     * @return BelongsToMany
     */
    public function skus()
    {
        return $this->belongsToMany(related: Sku::class)->withPivot(columns: ['count', 'price'])->withTimestamps();
    }

    /**
     * @return BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(related: Currency::class);
    }

    /**
     * This method creates the relation between order and Coupon class
     * which is responsable for the coupon functional in the orders.
     *
     * @return BelongsTo
     */
    public function coupon()
    {
        return $this->belongsTo(related: Coupon::class);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * @return int
     */
    public function calculateFullSum()
    {
        $sum = 0;
        foreach ($this->skus()->withTrashed()->get() as $sku) {
            $sum += $sku->getPriceForCount();
        }
        return $sum;
    }

    /**
     * @return float|int
     */
    public function getFullSum($withCoupon = true)
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
     * @param $name
     * @param $phone
     * @return bool
     */
    public function saveOrder($name, $phone)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->status = 1;
        $this->sum = $this->getFullSum();

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
    public function hasCoupon()
    {
        return $this->coupon;
    }
}
