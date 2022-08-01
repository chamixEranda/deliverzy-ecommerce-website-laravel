<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Reviews;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Products::paginate(10);
        return view('Admin.products')->with('products',$product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $maxid = DB::table('products')->max('id')+1;
        $supplier = Supplier::all();
        return view('Admin.addProducts')->with('maxid',$maxid)->with('supplier',$supplier);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier' => 'required',
            'itemname' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'imagepath' => 'required|mimes:jpg,png,jpeg|max:5048'
        ],[
            'category.required' => 'Select item category.',
            'supplier.required' => 'Select the supplier.'
        ]);

         $newImageName = time() . '-' .$request->itemname . '.' . $request->id . '.'. $request->imagepath->extension();
         $request->imagepath->move(public_path('productImages'),$newImageName);

         $product = new Products();
         $product->supplier_id = $request->supplier;
         $product->id = $request->id;
         $product->name = $request->itemname;
         $product->category = $request->category;
         $product->price = $request->price;
         $product->quantity = $request->quantity;
         $product->imagepath = $newImageName;
         $save = $product->save();

         if ($save) {
             return redirect()->route('admin.Products')->with('successAddItem','Product added successfully');
         }else {
             return redirect()->back()->with('fail','Something went wrong');
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
        $product = Products::with('reviews','reviews.user')->find($id);

        if (!$product) {
            return abort(404);
        }
        $related = Products::where('category',$product->category)->whereNotIn('id',[$id])->inRandomOrder()->get();
        return view('Products.showProduct')->with('product',$product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Products::find($id);
        return view('Admin.editProducts')->with('product',$product);
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
        $request->validate([
            'itemname' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'imagepath' => 'required|mimes:jpg,png,jpeg|max:5048'
        ],[
            'category.required' => 'Select item category'
        ]);


        $update = Products::where('id',$id)
            ->update([
                'name' => $request->input('itemname'),
                'category' => $request->input('category'),
                'price' => $request->input('price'),
                'quantity' => $request->input('quantity'),

            ]);
            if ($request->hasfile('imagepath')) {
                $newImageName = time() . '-' .$request->itemname . '.' . $request->id . '.'. $request->imagepath->extension();
                $request->imagepath->move(public_path('productImages'),$newImageName);

                DB::table('products')
                    ->where('id',$id)
                    ->update(['imagepath'=> $newImageName]);
            }
             if ($update) {
             return redirect()->route('admin.Products')->with('successUpdateItem','Product updated successfully');
            }else {
             return redirect()->back()->with('fail','Something went wrong');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Products::find($id)->delete();
        return redirect()->route('admin.Products')->with('successDelete','Product ID '.$id.' deleted successfully');
    }

}
