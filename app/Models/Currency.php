<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'rate'
    ];

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
     * @return bool
     */
    public function isMain(): bool
    {
        return $this->is_main === 1;
    }
}
