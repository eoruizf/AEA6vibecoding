<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const ROLE_USER  = 'user';
    public const ROLE_ADMIN = 'admin';
    public const ROLES = [self::ROLE_USER, self::ROLE_ADMIN];

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'contact_phone',
        'contact_email',
        'photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function scopeAdmins($query)
    {
        return $query->where('role', self::ROLE_ADMIN);
    }

    

    public function dogs(): HasMany
    {
        return $this->hasMany(Dog::class);
    }
    public function getRoleLabelAttribute(): string
    {
        return $this->isAdmin() ? 'Administrador' : 'Usuario';
    }
    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo ? Storage::disk('public')->url($this->photo) : null;
    }

    public function adoptionDogs(): HasMany { 
        return $this->hasMany(AdoptionDog::class); 
    }

    public function events(): HasMany       { 
        return $this->hasMany(Event::class); 
    }

    public function comments(): HasMany     { 
        return $this->hasMany(Comment::class); 
    }

    public function likes(): HasMany        { 
        return $this->hasMany(Like::class); 
    }

    public function favorites(): HasMany    { 
        return $this->hasMany(Favorite::class); 
    }
    
}