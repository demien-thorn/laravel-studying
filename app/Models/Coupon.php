<?php

namespace App\Models;

use App\Services\CurrencyConversion;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coupon extends Model
{
    use HasFactory;

    /**
     * This array of values indicates the columns we need to fill when createing a new coupon.
     *
     * @var string[]
     */
    protected $fillable = ['code', 'value', 'type', 'currency_id', 'only_once', 'expired_at', 'description',];

    /**
     * Converts field "expired_at" into a formating type (for we could apply the ->format('') method further).
     *
     * @var string[]
     */
    protected $dates = ['expired_at'];

    /**
     * This method creates the relations between two models: this one and Order.
     *
     * @return HasMany
     */
    public function orders()
    {
        return $this->hasMany(related: Order::class);
    }

    /**
     * This method creates the relations between two models: this one and Currency.
     *
     * @return BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(related: Currency::class);
    }

    /**
     * Method checks wheter the coupon's field "type" indicated as 1 or 0.
     *
     * @return bool
     */
    public function isAbsolute()
    {
        return $this->type === 1;
    }

    /**
     * Method checks wheter the coupon's field "only_once" indicated as 1 or 0.
     *
     * @return bool
     */
    public function isOnlyOnce()
    {
        return $this->only_once === 1;
    }

    /**
     * Method checks if coupon is available not for only one use (method isOnlyOnce())
     * or whether it was in use in any other orders or not;
     * if it's not - returns the date of expiring of the coupon
     * (checks if it's null or if the current date is greater then it's expiring date).
     * In any other cases - returns false.
     *
     * Usage: BasketController->setCoupon
     *
     * @return bool
     */
    public function availableForUse()
    {
        $this->refresh();
        if (!$this->isOnlyOnce() || $this->orders->count() === 0) {
            return is_null(value: $this->expired_at) || $this->expired_at->gte(Carbon::now());
        }
        return false;
    }

    /**
     * @param $price
     * @param Currency|null $currency
     * @return float|int
     */
    public function applyCost($price, Currency $currency = null)
    {
        if ($this->isAbsolute()) {
            return $price - CurrencyConversion::convert(
                sum: $this->value,
                originCurrencyCode: $this->currency->code,
                targetCurrencyCode: $currency->code
            );
        } else {
            return $price - ($price * $this->value / 100);
        }
    }
}
