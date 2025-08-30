<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuoteRequestItem extends Model
{
<<<<<<< Updated upstream:Madarom-project/app/Models/QuoteRequestItem.php
    protected $fillable =  ['quote_request_id','product_id', 'quantity', 'price_snapshot' ];
=======
    protected $fillable =  ['quote_request_id','product_id', 'quantity', 'price_snapshot', 'price_snapshot_mga' ];
>>>>>>> Stashed changes:app/Models/QuoteRequestItem.php

    public function quoteRequest(): belongsTo
    {
        return $this->belongsTo(QuoteRequest::class);
    }

    public function product(): belongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
