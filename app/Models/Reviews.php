<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;
use App\Models\User;

class Reviews extends Model
{
    use HasFactory;

    public function products(){
        return $this->belongsTo(Products::class, 'products_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
