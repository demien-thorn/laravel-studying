<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyOption extends Model
{
    use HasFactory, SoftDeletes, Translatable;

    protected $fillable = [
        'propery_option_id',
        'name',
        'name_en',
    ];

    public function property()
    {
        return $this->belongsTo(related: Property::class);
    }

    //TODO: check table name and fields
    public function skus()
    {
        return $this->belongsToMany(related: Sku::class);
    }
}
