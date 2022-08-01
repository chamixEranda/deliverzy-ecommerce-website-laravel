<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasingOrderProducts extends Model
{
    use HasFactory;

    public function purchasing_orders(){
        return $this->belongsTo(PurchasingOrder::class, 'po_id', 'id');
    }
}
