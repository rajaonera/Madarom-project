<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

//    public static function where(string $string, mixed $email)
//    {
//        return self::where('email', $email);
//    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function quotes(): HasMany
    {
        return $this->hasMany(Quote::class);
    }

    public function quoteRequests(): HasMany
    {
        return $this->hasMany(QuoteRequest::class);
    }

    public function getRole()
    {
        return $this->attributes['role'];
    }

    public function setRole($role):void
    {
        $this->attributes['role'] = $role;
    }

    public function getId()
    {
        return $this->attributes['id'];
    }
    public function setId($id):void
    {
        $this->attributes['id'] = $id;
    }

    public function getEmail()
    {
        return $this->attributes['email'];
    }
    public function setEmail($email):void
    {
        $this->attributes['email'] = $email;
    }

    public function getName()
    {
        return $this->attributes['name'];

    }
    public function setName($name):void
    {
        $this->attributes['name'] = $name;
    }

    public function getPassword()
    {
        return $this->attributes['password'];
    }
    public function setPassword($password):void
    {
        $this->attributes['password'] = $password;
    }

}
