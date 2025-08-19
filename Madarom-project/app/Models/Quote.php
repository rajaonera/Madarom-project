<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quote extends Model
{
    protected $fillable = ['id','user_id','quote_request_id','reference','day','hours', 'status', 'notes'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items (): HasMany
    {
        return $this->hasMany(QuoteRequestItem::class);
    }

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
    public  function getUser_id(): string
    {
        return $this->attributes['user_id'];
    }
    public function setUser_id($value): void
    {
        $this->attributes['user_id'] = strtolower($value); // Enregistre en minuscules
    }

    public function getQuote_request(): String
    {
        return $this->attributes['quote_request_id'];
    }

    public function setQuote_request($value):void
    {
        $this->attributes['quote_request_id'] = $value;
    }

    public function getReference(): String
    {
        return $this->attributes['reference'];
    }

    public function setReference($value):void
    {
        $this->attributes['reference'] = $value;
    }

    public function getDay(): String
    {
        return $this->attributes['day'];
    }

    public function setDay($value):void
    {
        $this->attributes['day'] = $value;
    }

    public function getHours(): String
    {
        return $this->attributes['hours'];
    }

    public function setHours($value):void
    {
        $this->attributes['hours'] = $value;
    }
    public function getStatus(): String
    {
        return $this->attributes['status'];
    }

    public function setStatus($value):void
    {
        $this->attributes['status'] = $value;
    }
    public function getNotes(): String
    {
        return $this->attributes['notes'];
    }

    public function setNotes($value):void
    {
        $this->attributes['notes'] = $value;
    }

}
