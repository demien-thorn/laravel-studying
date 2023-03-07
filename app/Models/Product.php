<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, Translatable;

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


    public function category()
    {
        return $this->belongsTo(related: Category::class);
    }

    public function getPriceForCount()
    {
        if (!is_null(value: $this->pivot)) {
            return $this->pivot->count * $this->price;
        }
        return $this->price;
    }


    public function scopeByCode($query, $code)
    {
        return $query->where('code', $code);
    }


    public function scopeHit($query)
    {
        return $query->where('hit', 1);
    }

    public function scopeNew($query)
    {
        return $query->where('new', 1);
    }

    public function scopeRecommend($query)
    {
        return $query->where('recommend', 1);
    }



    public function setNewAttribute($value)
    {
        $this->attributes['new'] = $value === 'on' ? 1 :0;
    }

    public function setHitAttribute($value)
    {
        $this->attributes['hit'] = $value === 'on' ? 1 :0;
    }

    public function setRecommendAttribute($value)
    {
        $this->attributes['recommend'] = $value === 'on' ? 1 :0;
    }


    public function isAvailable()
    {
        return !$this->trashed() && $this->count > 0;
    }


    public function isHit()
    {
        return $this->hit === 1;
    }

    public function isNew()
    {
        return $this->new === 1;
    }

    public function isRecommend()
    {
        return $this->recommend === 1;
    }
}
