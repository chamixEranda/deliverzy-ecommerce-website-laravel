<?php

namespace App\Http\Controllers\Wishlist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\WishlistProduct;
use Illuminate\Support\Facades\DB; 

class WishlistController extends Controller
{
    public function addToWishlist($product_id, $user_id){
        $wishlist_id = DB::table('wishlists')->where('user_id', $user_id)->first();

        $wishlist_product = new  WishlistProduct();
        $wishlist_product->products_id = $product_id;
        $wishlist_product->wishlist_id = $wishlist_id->id;
        $save = $wishlist_product->save();

        if($save){
            return redirect()->back();
        }
        else{
            // return redirect()->back();
            dd('no');
        }


    }

    public function removeFromWishlist($product_id, $user_id){ 

        $wishlist_id = DB::table('wishlists')->where('user_id', $user_id)->first();

        $delete = DB::table('wishlist_product')->where([
            ['products_id', $product_id],
            ['wishlist_id', $wishlist_id->id]
        ])->delete();

        if($delete){
            return redirect()->back();
        }
        else{
            // return redirect()->back();
            dd('no');
        }

    }
}
