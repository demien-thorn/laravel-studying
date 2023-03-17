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
    ];

    /**
     * @return BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(related: Product::class)->withPivot(columns: ['count', 'price'])->withTimestamps();
    }

    /**
     * @return BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(related: Currency::class);
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
        foreach ($this->products()->withTrashed()->get() as $product) {
            $sum += $product->getPriceForCount();
        }
        return $sum;
    }

    /**
     * @return float|int
     */
    public function getFullSum()
    {
        $sum = 0;

        foreach ($this->products as $product) {
            $sum += $product->price * $product->countInOrder;
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

        $products = $this->products;
        $this->save();

        foreach ($products as $productInOrder) {
            $this->products()->attach(id: $productInOrder, attributes: [
                'count' => $productInOrder->countInOrder,
                'price' => $productInOrder->price,
            ]);
        }

        session()->forget(keys: 'order');
        return true;
    }
}
