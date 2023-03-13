<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'currency_id',
        'sum',
    ];

    public function products()
    {
        return $this->belongsToMany(related: Product::class)->withPivot(columns: ['count', 'price'])->withTimestamps();
    }

    public function currency()
    {
        return $this->belongsTo(related: Currency::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function calculateFullSum()
    {
        $sum = 0;
        foreach ($this->products()->withTrashed()->get() as $product) {
            $sum += $product->getPriceForCount();
        }
        return $sum;
    }

    public function getFullSum()
    {
        $sum = 0;

        foreach ($this->products as $product) {
            $sum += $product->price * $product->countInOrder;
        }

        return $sum;
    }

    public function saveOrder($name, $phone)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->status = 1;
        $this->sum = $this->getFullSum();

        $products = $this->products;
//        dd($this);
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
