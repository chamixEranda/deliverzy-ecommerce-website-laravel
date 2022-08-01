<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Wishlist;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function homePage(){
        
        $top = DB::table('products')
                ->leftJoin('order_product', 'products.id', '=', 'order_product.products_id')
                ->selectRaw('products.*, COALESCE(sum(order_product.products_id),0) total')
                ->groupBy('products.id')
                ->orderBy('total', 'desc')
                ->take(10)
                ->get();

        return view('User.home', compact('top'));
    }
    public function aboutPage(){
        return view('User.about');
    }
    public function contactPage(){
        return view('User.contact');
    }
    public function categories(){
        return view('User.categories');
    }
    public function vegetables(){
        $product = Products::where('category','Vegetables')->paginate(15);
        return view('Products.vegetables')->with('product',$product);
    }
    public function fruitPage(){
        $product = Products::where('category', 'Fruits')->paginate(15);
        return view('Products.fruits')->with('product',$product);
    }
    public function dryPage(){
        $product = Products::where('category', 'Dry Rations')->paginate(15);
        return view('Products.dryration')->with('product',$product);
    }
    public function chillPage(){
        $product = Products::where('category', 'Chilled')->paginate(15);
        return view('Products.chilled')->with('product',$product);
    }
    public function beveragePage(){
        $product = Products::where('category', 'Beverages')->paginate(15);
        return view('Products.beverages')->with('product',$product);
    }
    public function backeryPage(){
        $product = Products::where('category', 'Backery')->paginate(15);
        return view('Products.backery')->with('product',$product);
    }
    public function meatPage(){
        $product = Products::where('category', 'Meat & SeaFood')->paginate(15);
        return view('Products.meat')->with('product',$product);
    }
    public function groceryPage(){
        $product = Products::where('category', 'Grocery')->paginate(15);
        return view('Products.grocery')->with('product',$product);
    }
    public function othersPage(){
        $product = Products::where('category', 'Others')->paginate(15);
        return view('Products.others')->with('product',$product);
    }
}
