<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;

class Supplier extends Model
{
    use HasFactory;

    // use Notifiable;

    public function products(){
        return $this->hasMany(Products::class);
    }

    public function purchasing_orders(){
        return $this->hasMany(PurchasingOrder::class);
    }
}
