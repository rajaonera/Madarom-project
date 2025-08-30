<?php

namespace App\Models;

use App\Http\Services\QuoteService;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Illuminate\Database\Eloquent\Relations\HasMany;
<<<<<<< Updated upstream:Madarom-project/app/Models/QuoteRequest.php
=======
use Illuminate\Database\Eloquent\Relations\HasOne;

>>>>>>> Stashed changes:app/Models/QuoteRequest.php

class QuoteRequest extends Model
{
    protected $fillable = ['id','user_id', 'status', 'notes', 'quote_number', 'created_at', 'updated_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items (): HasMany
    {
        return $this->hasMany(QuoteRequestItem::class);
    }
<<<<<<< Updated upstream:Madarom-project/app/Models/QuoteRequest.php
=======


    public function quote(): HasOne
    {
        return $this->hasOne(Quote::class, 'quote_request_id');
    }


>>>>>>> Stashed changes:app/Models/QuoteRequest.php
    public function is_validated(): bool
    {
        if($this->status == 'validated')
        {
            return true;
        }
        return false;
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function setId($value): void
    {
        $this->attributes['id'] = $value;
    }

    public function getQuote_number(): String
    {
        return $this->attributes['quote_number'];

    }
    public function setQuote_number($value): void
    {
        $this->attributes['quote_number'] = $value;
    }
    public function getNotes(): String
    {
        return $this->attributes['notes'];
    }
    public function setNotes($value): void
    {
        $this->attributes['notes'] = $value;
    }
    public function getStatus(): String
    {
        return $this->attributes['status'];
    }
    public function setStatus($value): void
    {
        $this->attributes['status'] = $value;
    }
    public function getUserId(): String
    {
        return $this->attributes['user_id'];
    }
    public function setUserId($value): void
    {
        $this->attributes['user_id'] = $value;
    }

    public function getCreatedAt(): String
    {
        return $this->attributes['created_at'];

    }
    public function setCreatedAt($value): void
    {
        $this->attributes['created_at'] = $value;
    }
    public function getUpdatedAt(): String
    {
        return $this->attributes['updated_at'];
    }
}
