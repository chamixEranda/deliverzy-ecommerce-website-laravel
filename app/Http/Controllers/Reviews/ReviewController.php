<?php

namespace App\Http\Controllers\Reviews;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reviews;
use App\Models\Products;

class ReviewController extends Controller
{
    // public function index(){
    //     $review = ReviewController::get();
    //     return view('User.addreview')->with('reviews',$review); 
    // }

    public function store(Request $request)
    {
        try{
            // dd($request);
            $request->validate([
                'rating' => 'required',
                'comment' => 'required|max:250',
            ],[
                'rating.required' => 'At least one rating star must be selected.',
            ]);
    
            $review = new Reviews();
            $review->comment = $request->comment;
            $review->rating = $request->rating;
            $review->products_id = $request->products_id;
            $review->user_id = $request->user_id;
            $save = $review->save();
    
            if($save){
                return redirect()->route('productshow',$request->products_id.'#reviewSection')->with('success-add','Your review successfully added');
            }else{
                return redirect()->back();
            }

        }        
        catch(QueryException $ex){
            return redirect()->back()->with('exception-error','An error occurred, please try again later');
        }
    }

    public function create($id)
    {
        $product = Products::find($id);
        return view('User.addreview')->with('product',$product);
    }

    public function destroy($id)
    {
        $review = Reviews::find($id)->delete();

        return redirect()->back()->with('success-delete','Review delete successfully.');

    }
}
