<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Wishlist;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Reviews;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /** 
     * The attributes that are mass assignable.
     *
     * @var array<int, string> 
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'home',
        'street',
        'city',
        'province',
        'email',
        'mobile',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function wishlists(){
        return $this->hasOne(Wishlist::class);
    }

    public function carts(){
        return $this->hasOne(Cart::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function reviews(){
        return $this->hasMany(Reviews::class);
    }

}
