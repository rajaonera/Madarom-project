<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'name_fr', 'name_latin', 'description_fr', 'description_en',
        'category_id', 'subcategory_id', 'image_path'
    ];

    // public static function findOrFail($id): \Illuminate\Http\JsonResponse
    // {
        // return Product::findOrFail($id);
    // }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }

    public function quoteRequests(): HasMany
    {
        return $this->hasMany(QuoteRequest::class);
    }

    public function activePrice()
    {
        return $this->hasOne(Price::class)
            ->where('is_active', true)
            ->where('effective_date', '<=', now())
            ->orderBy('effective_date', 'desc');
    }

}
