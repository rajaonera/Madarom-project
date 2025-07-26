<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuoteRequestItem extends Model
{
    protected $fillable =  ['quote_request_id','product_id', 'quantity' ];

    public function quoteRequest(): belongsTo
    {
        return $this->belongsTo(QuoteRequest::class);
    }

    public function product(): belongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
