<?php

namespace App\Models;

use App\Mail\SendSubscriptionMessage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Mail;

class Subscription extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'email',
        'sku_id'
    ];

    /**
     * @param $query
     * @param $skuId
     * @return mixed
     */
    public function scopeActiveBySkuId($query, $skuId)
    {
        return $query->where('status', 0)->where('sku_id', $skuId);
    }

    /**
     * @return BelongsTo
     */
    public function sku()
    {
        return $this->belongsTo(related: Sku::class);
    }

    /**
     * @param Sku $sku
     */
    public static function sendEmailsBySubscription(Sku $sku)
    {
        $subscriptions = self::activeBySkuId($sku->id)->get();

        foreach ($subscriptions as $subscription) {
            Mail::to(users: $subscription->email)->send(mailable: new SendSubscriptionMessage(sku: $sku));
            $subscription->status = 1;
            $subscription->save();
        }
    }
}
