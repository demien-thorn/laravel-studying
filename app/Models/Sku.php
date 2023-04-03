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
     * Contains array of the fieldnames which required to fill when creating new SKU.
     *
     * @var string[]
     */
    protected $fillable = ['product_id', 'count', 'price',];

    /**
     * Contains array of the fieldnames which are used when generating an api-request.
     *
     * @var string[]
     */
    protected $visible = ['id', 'count', 'price', 'product_name'];

    /**
     * @return BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(related: Product::class);
    }

    /**
     * Rerurns skus which count is greater then 0.
     *
     * Note: "scope"-methods are usable when we copy the name of the "scope"-method after "scope..." in it's name.
     * The copied method must start with a small character.
     *
     * Usage: App\Http\Controllers\Api\SkusController
     *
     * @param $query - contains a query to DB
     * @return mixed - some responsed data from DB
     */
    public function scopeAvailable($query)
    {
        return $query->where('count', '>', 0);
    }

    /**
     * @return BelongsToMany
     */
    public function propertyOptions()
    {
        return $this->belongsToMany(related: PropertyOption::class, table: 'sku_property_option')->withTimestamps();
    }

    /**
     * @return bool
     */
    public function isAvailable()
    {
        return !$this->product->trashed() && $this->count > 0;
    }

    /**
     * @return float|int|mixed
     */
    public function getPriceForCount()
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
     * @return float - returns the converted out price
     */
    public function getPriceAttribute($value)
    {
        return round(num: CurrencyConversion::convert(sum: $value));
    }

    /**
     * Method returns product's name when calling API.
     *
     * @return mixed - product's name
     */
    public function getProductNameAttribute()
    {
        return $this->product->name;
    }
}
