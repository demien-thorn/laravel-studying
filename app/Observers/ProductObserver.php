<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Subscription;

class ProductObserver
{
    /**
     * Handle the Product "updated" event.
     *
     * @param  Product  $product
     * @return void
     */
    public function updating(Product $product)
    {
        $oldCount = $product->getOriginal(key: 'count');

        if ($oldCount == 0 && $product->count > 0) {
            Subscription::sendEmailsBySubscription($product);
        }
    }
}
