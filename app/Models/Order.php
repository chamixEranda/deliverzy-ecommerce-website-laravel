<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;
use App\Models\Delivery;
use App\Models\Invoice;
use App\Models\OrderProduct;

class Order extends Model
{
    use HasFactory;

    public function products(){
        return $this->belongsToMany(Products::class,'order_product')->withPivot('id','order_quantity');
    }
    
    public function users(){  
        return $this->belongsTo(User::class,'user_id', 'id');
    }

    public function deliveries(){
        return $this->hasOne(Delivery::class);
    }

    public function invoices(){
        return $this->hasOne(Invoice::class);
    }

    public function delivery_people(){
        return $this->hasOne(DeliveryPerson::class);
    }
}
