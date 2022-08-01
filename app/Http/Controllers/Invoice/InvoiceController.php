<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Order;

class InvoiceController extends Controller
{
    public function CustomerinvoiceGenarate($id){
        $orders = Order::with('deliveries', 'invoices','products','users')->find($id);

        if(!$orders){
            return abort(404);
        }

        return view('Admin.customerInvoice')->with('orders', $orders);
    }
}
