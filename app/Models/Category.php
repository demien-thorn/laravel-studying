<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'code',
        'name',
        'description',
        'image',
        'name_ru',
        'description_ru'
    ];

    public function products()
    {
        return $this->hasMany(related: Product::class);
    }
}
