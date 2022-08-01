<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartProduct;
use Illuminate\Support\Facades\DB; 

class CartController extends Controller
{
    public function addToCart(Request $request){
        // dd($request);

        $request->validate([
            'quantity' => 'required|numeric'
        ]);

        $cart_id = DB::table('carts')->where('user_id', $request->user_id)->first();
        $cart = DB::table('cart_product')->where([
            ['cart_id', $cart_id->id],
            ['products_id', $request->products_id],
        ])->first();

        if($cart) {
             if(($cart->quantity + $request->quantity) <= $request->product_quantity){
                $update = CartProduct::where('id', $cart->id)
                ->update([
                    'quantity' => $cart->quantity + $request->input('quantity')
                ]);

                return redirect()->route('user.My-Cart')->with('cartAddSuccess', $request->products_name.' has been added to your cart');
             }
             else{
    
                 return redirect()->route('user.My-Cart')->with('stockError', 'You cannot add that amount to the cart — we have '.$request->product_quantity.' in stock and you already have '.$cart->quantity.' in your cart');
             }
        }
        
        else{
            $cartProduct = new CartProduct();
            $cartProduct->cart_id = $cart_id->id;
            $cartProduct->products_id = $request->products_id;
            $cartProduct->quantity = $request->quantity;
            $save = $cartProduct->save();

            return redirect()->route('user.My-Cart')->with('cartAddSuccess', $request->products_name.' has been added to your cart');
        }

    }


    public function removeFromCart($id){

        $delete = CartProduct::find($id)->delete();

        if($delete){
            return redirect()->back()->with('cartRemoveSuccess', 'Item Remove successfully');
        }
        else{
            return redirect()->back();
        }
    }
 
    public function updateCart(Request $request){

        for($c = 0; $c < count($request->cart_product_id); $c++ ){

            $update = CartProduct::where('id',$request->cart_product_id[$c])
                ->update(
                    [ 'quantity' => $request->quantity[$c]]
                );
        }
        
        return redirect()->back()->with('cartUpdateSuccess',' Cart update successfully');
    }

}
