<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Products;
use App\Models\Invoice;
use App\Models\Delivery;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function check(Request $request){ 
        //validate inputs
        $request->validate([
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|min:5|max:20'
        ]);

        $creds = $request->only('email','password');
        if (Auth::guard('admin')->attempt($creds)) {
            return redirect()->route('admin.Dashboard');
        }else {
            return redirect()->route('admin.Login')->with('fail','Email or Password is Incorrect');
        }
    }
    function logout(){
        Auth::logout();
        return redirect()->route('admin.Login');
    }

    function dashboard() {
        $pro = Products::get()->count();
        $sale = Invoice::get()->sum("total_bill");
        $dalivery = Delivery::get()->count();
        $c_orders = Delivery::where('deliver_status', '=', 'P')->count();
        $p_orders = Delivery::where('deliver_status', '=', 'P')->count();
        // dd($c_orders);

        $salseChart = [];

        $invoice = Invoice::select(

            DB::raw("SUM(total_bill) as total"),

            DB::raw("MONTHNAME(created_at) as month_name")

        )->whereYear('created_at', date('Y'))->groupBy('month_name')->orderBy('created_at')->get();


        foreach($invoice as $row) {
            $salseChart['label'][] = substr($row->month_name,0,3);;
            $salseChart['data'][] = (int)$row->total;
        }

        $salseChart['sales_chart_data'] = json_encode($salseChart);


        return view('Admin.dashboard')->with([
            'pro' => $pro,
            'sale' => $sale,
            'dalivery' => $dalivery,
            'c_orders' => $c_orders,
            'p_orders' => $p_orders,
            'sales_chart_data' => $salseChart
        ]);
    }
}
