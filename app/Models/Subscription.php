<?php

namespace App\Models;

use App\Mail\SendSubscriptionMessage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'product_id'
    ];

    public function scopeActiveByProductId($query, $productId)
    {
        return $query->where('status', 0)->where('product_id', $productId);
    }

    public function product()
    {
        return $this->belongsTo(related: Product::class);
    }

    public static function sendEmailsBySubscription(Product $product)
    {
        $subscriptions = self::activeByProductId($product->id)->get();

        foreach ($subscriptions as $subscription) {
            Mail::to(users: $subscription->email)->send(mailable: new SendSubscriptionMessage($product));
            $subscription->status = 1;
            $subscription->save();
        }
    }
}
