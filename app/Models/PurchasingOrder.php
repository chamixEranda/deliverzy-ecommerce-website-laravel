<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasingOrder extends Model
{
    use HasFactory;

    public function suppliers(){
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function purchasing_order_products(){ 
        return $this->hasMany(PurchasingOrderProducts::class);
    }
}
