<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;

class Cart extends Model
{
    use HasFactory;

    public function products(){
        return $this->belongsToMany(Products::class,'cart_product')->withPivot('id','quantity');
    }
 
    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
