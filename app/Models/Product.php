<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, Translatable;

    /**
     * @var string[]
     */
    protected $fillable = [
        'code',
        'category_id',
        'name',
        'price',
        'description',
        'image',
        'new',
        'hit',
        'recommend',
        'count',
        'name_ru',
        'description_ru',
    ];


    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(related: Category::class);
    }

    /**
     * @return HasMany
     */
    public function skus(): HasMany
    {
        return $this->hasMany(related: Sku::class);
    }

    /**
     * @return BelongsToMany
     */
    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(related: Property::class, table: 'property_product')->withTimestamps();
    }


    /**
     * @param $query
     * @param $code
     * @return mixed
     */
    public function scopeByCode($query, $code): mixed
    {
        return $query->where('code', $code);
    }


    /**
     * @param $query
     * @return mixed
     */
    public function scopeHit($query): mixed
    {
        return $query->where('hit', 1);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeNew($query): mixed
    {
        return $query->where('new', 1);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeRecommend($query): mixed
    {
        return $query->where('recommend', 1);
    }


    /**
     * @param $value
     */
    public function setNewAttribute($value): void
    {
        $this->attributes['new'] = $value === 'on' ? 1 :0;
    }

    /**
     * @param $value
     */
    public function setHitAttribute($value): void
    {
        $this->attributes['hit'] = $value === 'on' ? 1 :0;
    }

    /**
     * @param $value
     */
    public function setRecommendAttribute($value): void
    {
        $this->attributes['recommend'] = $value === 'on' ? 1 :0;
    }


    /**
     * @return bool
     */
    public function isHit(): bool
    {
        return $this->hit === 1;
    }

    /**
     * @return bool
     */
    public function isNew(): bool
    {
        return $this->new === 1;
    }

    /**
     * @return bool
     */
    public function isRecommend(): bool
    {
        return $this->recommend === 1;
    }
}
