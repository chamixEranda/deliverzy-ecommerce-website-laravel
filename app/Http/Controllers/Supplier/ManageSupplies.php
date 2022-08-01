<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PurchasingOrder;
use App\Models\PurchasingOrderProducts;
use App\Models\Supplier;
use App\Notifications\RequestOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\SendEmail;
use Mail;

class ManageSupplies extends Controller
{
    public function index(){
        $purchasingorder = PurchasingOrder::with('suppliers', 'purchasing_order_products')->paginate(10);
        return view('Admin.purchasingOrder')->with('purchasingorder', $purchasingorder);
    }

    public function create(){
        $maxid = DB::table('purchasing_orders')->max('id')+1;
        $supplier = Supplier::all();
        return view('Admin.newsupply')->with('maxid',$maxid)->with('supplier', $supplier);
    }

    public function store(Request $request){
        // dd($request);
        $request->validate([
            'supplier' => 'required',
            'productname' => 'required',
            'quantity' => 'required',
        ],[
            'supplier.required' => 'Select the supplier',
            'productname.required' => 'At least one product must be enter'
        ]);

        $purchaseorder = new PurchasingOrder();
        $purchaseorder->id = $request->id;
        $purchaseorder->supplier_id = $request->supplier;
        $purchaseorder->decription = $request->description;
        $save = $purchaseorder->save();

        foreach ($request->productname as $key=>$oneProduct) {
            $purchasingorderproducts = new PurchasingOrderProducts();
            $purchasingorderproducts->purchasing_order_id = $request->id;
            $purchasingorderproducts->product_name = $oneProduct;
            $purchasingorderproducts->order_qty = $request->quantity[$key];
            $save = $purchasingorderproducts->save();
        }

        $supplier = Supplier::find($request->supplier);
        
        $email = $supplier->company_email;
   
        $maildata = [
            'product_name' => $request->productname,
            'qty' => $request->quantity,
            'description' => $request->description,
            'po_id' => $request->id,
        ];
        

        Mail::to($email)->send(new SendEmail($maildata));

        if ($save) {
            return redirect()->route('admin.PurchasingRequest')->with('success','Request sent successfully');
        }
        else{
            return redirect()->back()->with('fail','Something went wrong');
        }



    }

    public function show($id){
        $purchaseorder = PurchasingOrder::with('suppliers', 'purchasing_order_products')->find($id);
        if(!$purchaseorder){
            return abort(404);
        }
        return view('Admin.purchaseOrderView')->with('purchaseorder',$purchaseorder); 
    }

    public function update(Request $request){
        // dd($request);
        foreach ($request->pop_id as $key => $Onepop_id) {
            $update = PurchasingOrderProducts::where('id',$Onepop_id)
            ->update(
                ['recieved_qty' => $request->recieved_qty[$key],'return_qty' => $request->return_qty[$key]],
                
            );
        }
        return redirect()->back()->with('updateSuccsess',' Purchasing Order update successfully');
    }
}
