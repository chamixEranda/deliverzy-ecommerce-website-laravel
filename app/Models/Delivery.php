<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Delivery extends Model
{
    use HasFactory;

    public function orders(){
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function delivery_people(){
        return $this->hasOne(DeliveryPerson::class);
    }
}
