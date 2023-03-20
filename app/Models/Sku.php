<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sku extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'product_id',
        'count',
        'price',
    ];

    /**
     * @return BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(related: Product::class);
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
}
