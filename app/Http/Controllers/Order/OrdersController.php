<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\Delivery;
use App\Models\Products;
use App\Models\User;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('deliveries', 'invoices')->paginate(10);

        return  view('Admin.orders')->with('orders', $orders); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            // dd(Auth::user()->carts);
                $nextOrderId = DB::table('orders')->max('id')+1;
                $cartProducts = DB::table('cart_product')->where('cart_id',Auth::user()->carts->id)->get();

                $order = new Order();
                $order->id = $nextOrderId;
                $order->payment_method = $request->paymentMethod;
                $order->user_id = Auth::user()->id;
                $order->save();

                foreach ($cartProducts as  $oneCartProduct) {
                    $orderProducts = new OrderProduct();
                    $orderProducts->order_id = $nextOrderId;
                    $orderProducts->products_id = $oneCartProduct->products_id;
                    $orderProducts->order_quantity = $oneCartProduct->quantity;
                    $orderProducts->save();
                }

                foreach ($cartProducts as  $oneCartProduct) {

                    $products =  Products::find($oneCartProduct->products_id);

                    $newQuantity =  $products->quantity - $oneCartProduct->quantity;

                    $update = Products::where('id', $oneCartProduct->products_id)
                    ->update(['quantity' => $newQuantity
                    ]);
                }

                $invoice = new Invoice();
                $invoice->order_id=$nextOrderId;
                $invoice->total_bill = (int)ceil($request->subTotal);
                if($request->paymentMethod == "C"){
                    $invoice->payment_status = "P";
                }
                $invoice->tax_amount = (int)ceil($request->tax);
                $invoice->save();

                $delivery = new Delivery();
                $delivery->order_id = $nextOrderId;
                $delivery->deliver_status = 'P';
                $delivery->save();

                $delete = DB::table('cart_product')->where('cart_id', Auth::user()->carts->id)->delete();

                if($delete){
                    return redirect()->route('user.My-Orders')->with('order-conform','Your order id is #'.$nextOrderId);
                }
                else{
                    return redirect()->back();
                }

            }

        catch(QueryException $ex){
            return redirect()->back()->with('exception-error','An error occurred, please try again later');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orders = Order::with('deliveries','invoices','products','users')->find($id);
        if(!$orders){
            return abort(404);
        }
        return view('Admin.orderView')->with('orders',$orders); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function checkoutPage(){
        return view('User.checkout');
    }

    public function viewOrder($id){
        $checkOrder = DB::table('orders')->where([
            ['id' , $id],
            ['user_id' , Auth::user()->id]
        ])->first();

        if($checkOrder){
            $order = Order::with('deliveries','invoices','products','user')->find($id);
        
            return view('User.myorder')->with('orders', $order);
        }
        else{
            return abort(404);
        }
    }
}
