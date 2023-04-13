<?php

namespace App\Models;

use App\Services\CurrencyConversion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sku extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Contains an array of the fieldnames which required to fill when creating new SKU.
     *
     * @var string[]
     */
    protected $fillable = ['product_id', 'count', 'price',];

    /**
     * Contains an array of the fieldnames which are used when generating an api-request.
     *
     * @var string[]
     */
    protected $visible = ['id', 'count', 'price', 'product_name'];

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(related: Product::class);
    }

    /**
     * Returns skus which count is greater than 0.
     *
     * Note: "scope"-methods are usable when we copy the name of the "scope"-method after "scope..."
     * in its name.
     * The copied method must start with a small character.
     *
     * Usage: App\Http\Controllers\Api\SkusController
     *
     * @param $query - contains a query to DB
     * @return mixed - some responded data from DB
     */
    public function scopeAvailable($query): mixed
    {
        return $query->where('count', '>', 0);
    }

    /**
     * @return BelongsToMany
     */
    public function propertyOptions(): BelongsToMany
    {
        return $this->belongsToMany(related: PropertyOption::class, table: 'sku_property_option')->withTimestamps();
    }

    /**
     * @return bool
     */
    public function isAvailable(): bool
    {
        return !$this->product->trashed() && $this->count > 0;
    }

    /**
     * @return float|int|mixed
     */
    public function getPriceForCount(): mixed
    {
        if (!is_null(value: $this->pivot)) {
            return $this->pivot->count * $this->price;
        }
        return $this->price;
    }

    /**
     * Method calls the CurrencyConversion::convert method to convert prices of products to other currencies.
     *
     * @param $value - gets the price of the product
     * @return float|int - returns the converted out price
     */
    public function getPriceAttribute($value): float|int
    {
        return round(num: CurrencyConversion::convert(sum: $value));
    }

    /**
     * Method returns product's name when calling API.
     *
     * @return mixed - product's name
     */
    public function getProductNameAttribute(): mixed
    {
        return $this->product->name;
    }
}
