<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Quote extends Model
{
    protected $fillable = ['user_id', 'status','quote_number', 'notes'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items (): HasOne
    {
        return $this->hasOne(QuoteRequest::class);
    }
    public function is_validated(): bool
    {
        if($this->status == 'validated')
        {
            return true;
        }
        return false;
    }
}
