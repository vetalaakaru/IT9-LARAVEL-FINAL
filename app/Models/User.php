<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     * These must match the columns in your migration exactly.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',         // 'buyer', 'seller', or 'admin'
        'status',       // 'pending', 'approved', 'rejected'
        'shop_name',    
        'owner_name',   
        'valid_id',     
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Role Helpers
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isSeller(): bool
    {
        return $this->role === 'seller';
    }

    public function isBuyer(): bool
    {
        return $this->role === 'buyer';
    }

    /**
     * Relationship: A seller can own many products.
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'seller_id');
    }
}