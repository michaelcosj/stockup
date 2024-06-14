<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockList extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tag',
        'description',
    ];

    /**
     * BelongsTo relationship with the user that owns this stock lists.
     *
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
