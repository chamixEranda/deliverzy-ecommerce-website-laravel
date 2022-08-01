<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Wishlist;
use App\Models\Cart;
use App\Models\Order;
use App\Models\SupplyOrder;
use App\Models\Reviews;

class Products extends Model
{
    use HasFactory;

    public function wishlists(){
        return $this->belongsToMany(Wishlist::class, 'wishlist_product'); 
    }

    public function carts(){
        return $this->belongsToMany(Cart::class, 'cart_product')->withPivot('quantity'); 
    }

    public function orders(){
        return $this->belongsToMany(Order::class, 'order_product')->withPivot('order_quantity');
    }

    public function supplyorders(){
        return $this->belongsToMany(SupplyOrder::class, 'supply_order_product')->withPivot('quantity');
    }

    public function reviews(){
        return $this->hasMany(Reviews::class);
    }

    public function suppliers(){
        
    }
 
    protected $table = 'products';
}
 