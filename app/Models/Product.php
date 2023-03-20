<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use App\Services\CurrencyConversion;
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
    public function category()
    {
        return $this->belongsTo(related: Category::class);
    }

    /**
     * @return HasMany
     */
    public function skus()
    {
        return $this->hasMany(related: Sku::class);
    }

    /**
     * @return BelongsToMany
     */
    public function properties()
    {
        return $this->belongsToMany(related: Property::class, table: 'property_product')->withTimestamps();
    }


    /**
     * @param $query
     * @param $code
     * @return mixed
     */
    public function scopeByCode($query, $code)
    {
        return $query->where('code', $code);
    }


    /**
     * @param $query
     * @return mixed
     */
    public function scopeHit($query)
    {
        return $query->where('hit', 1);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeNew($query)
    {
        return $query->where('new', 1);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeRecommend($query)
    {
        return $query->where('recommend', 1);
    }


    /**
     * @param $value
     */
    public function setNewAttribute($value)
    {
        $this->attributes['new'] = $value === 'on' ? 1 :0;
    }

    /**
     * @param $value
     */
    public function setHitAttribute($value)
    {
        $this->attributes['hit'] = $value === 'on' ? 1 :0;
    }

    /**
     * @param $value
     */
    public function setRecommendAttribute($value)
    {
        $this->attributes['recommend'] = $value === 'on' ? 1 :0;
    }


    /**
     * @return bool
     */
    public function isHit()
    {
        return $this->hit === 1;
    }

    /**
     * @return bool
     */
    public function isNew()
    {
        return $this->new === 1;
    }

    /**
     * @return bool
     */
    public function isRecommend()
    {
        return $this->recommend === 1;
    }

    /**
     * @param $value
     * @return float
     */
    public function getPriceAttribute($value)
    {
        return round(num: CurrencyConversion::convert($value));
    }
}
