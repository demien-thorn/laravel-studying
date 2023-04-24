<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

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
}
