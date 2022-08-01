<?php

namespace App\Http\Controllers\GRN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PurchasingOrder;
use App\Models\PurchasingOrderProducts;
use App\Models\Supplier;

class GenerateGoodRecievedNote extends Controller
{
    public function GenerateGRN($id){
        $purchaseorder = PurchasingOrder::with('suppliers','purchasing_order_products')->find($id);
        
        if(!$purchaseorder){
            return abort(404);
        } 
    
        return view('Admin.supplierGRN')->with('purchaseorder', $purchaseorder);
    }
    
}

