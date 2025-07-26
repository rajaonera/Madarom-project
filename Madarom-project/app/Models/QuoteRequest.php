<?php

namespace App\Models;

use App\Http\Services\QuoteService;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Illuminate\Database\Eloquent\Relations\HasMany;
class QuoteRequest extends Model
{
    protected $fillable = ['user_id', 'status', 'notes'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items (): HasMany
    {
        return $this->hasMany(QuoteRequestItem::class);
    }
}
