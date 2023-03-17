<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sku extends Model
{
    use HasFactory;

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
}
