<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
class Price extends Model
{
    protected $fillable = [
<<<<<<< Updated upstream:Madarom-project/app/Models/Price.php
        'product_id', 'amount', 'type', 'is_active', 'effectives_date'
=======
        'product_id', 'amount', 'amount_mga', 'type', 'is_active', 'effectives_date'
>>>>>>> Stashed changes:app/Models/Price.php
    ];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
<<<<<<< Updated upstream:Madarom-project/app/Models/Price.php
=======


>>>>>>> Stashed changes:app/Models/Price.php
