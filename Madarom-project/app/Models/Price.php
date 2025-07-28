<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
class Price extends Model
{
    protected $fillable = [
        'product_id', 'amount', 'type', 'is_active', 'effectives_date'
    ];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
