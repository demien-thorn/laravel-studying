<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory, Translatable;

    /**
     * @var string[]
     */
    protected $fillable = [
        'code',
        'name',
        'description',
        'image',
        'name_ru',
        'description_ru'
    ];

    /**
     * @return HasMany
     */
    public function products()
    {
        return $this->hasMany(related: Product::class);
    }
}
