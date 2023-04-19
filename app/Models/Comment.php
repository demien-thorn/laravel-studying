<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    /**
     * This array of values indicates the columns reuired to fill when creating a new comment.
     *
     * @var string[]
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'comment',
    ];

    /**
     * Creates a relation between this Model and Sku model.
     * BelongsTo indicates that this model belongs to the Sku model.
     *
     * @return BelongsTo
     */
    public function skus(): BelongsTo
    {
        return $this->belongsTo(related: Sku::class);
    }
}
