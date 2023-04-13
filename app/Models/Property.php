<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes, Translatable;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'name_ru',
    ];

    /**
     * @return HasMany
     */
    public function propertyOptions(): HasMany
    {
        return $this->hasMany(related: PropertyOption::class);
    }

    //TODO: check table name and fields
    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(related: Product::class);
    }
}
