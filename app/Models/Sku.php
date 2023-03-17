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

    //TODO: check table name and fields
    /**
     * @return BelongsToMany
     */
    public function skus()
    {
        return $this->belongsToMany(related: PropertyOption::class);
    }
}
