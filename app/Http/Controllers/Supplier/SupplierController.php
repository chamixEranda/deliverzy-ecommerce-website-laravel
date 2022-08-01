<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index()
    {
        $supplier = Supplier::paginate(100);
        return view('Admin.supplier')->with('supplier',$supplier);
    }

    public function create()
    {
        $maxid = DB::table('suppliers')->max('id')+1;
        return view('Admin.supplierRegister')->with('maxid',$maxid);
    }

    public function store(Request $request){
        $request->validate([
            'company_name' => 'required',
            'company_email' => 'required|email|unique:suppliers,company_email',
            'contact' => 'required|numeric|digits:10'
        ]);

        $supplier = new Supplier();
        $supplier->id = $request->id;
        $supplier->company_name = $request->company_name;
        $supplier->company_email = $request->company_email;
        $supplier->contact = $request->contact;
        $save = $supplier->save();

        if($save){
            return redirect()->route('admin.Suppliers')->with('successAddItem','Supplier registered successfully');
        }
        else{
            return redirect()->back()->with('fail','Something went wrong');
        }
    }

}
