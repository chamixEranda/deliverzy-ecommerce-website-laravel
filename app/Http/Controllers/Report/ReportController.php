<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Invoice;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\Products;
use App\Models\User;
use App\Models\OrderProduct;
use App\Models\PurchasingOrder;
use App\Models\PurchasingOrderProducts;

class ReportController extends Controller
{

    public function genarateReport(Request $request){
        $request->validate([
            'report' => 'required',
            'fromDate' => 'required',
            'toDate' => 'required',
        ],[
            'fromDate.required' => 'The From date field is required',
            'toDate.required' => 'The To date field is required',
        ]);

        if($request->report == "SR"){

            $data = DB::table('products')
            ->join('order_product','products.id','=','order_product.products_id')
            ->join('orders','orders.id','=','order_product.order_id')
            ->selectRaw('products.*, COALESCE(sum(order_product.order_quantity),0) total')
            ->groupBy(DB::raw('products.id'))
            ->orderBy('total','desc')
            ->whereBetween('orders.created_at', [Carbon::parse($request->fromDate)->toDateTimeString(),Carbon::parse($request->toDate)->toDateTimeString()])
            ->get();
            // $data = Order::with('products','invoices')->whereBetween('created_at', [Carbon::parse($request->fromDate)->toDateTimeString(),Carbon::parse($request->toDate)->toDateTimeString()])->get();

            if ($data->isEmpty()) {
                return redirect()->back()->with('report-empty', 'No data found. Please check FromDate and ToDate');
            }
            return view('Report.reportViewSales')->with('data', $data)->with('request', $request);
        }

        else if($request->report == "AR"){

            $data = DB::table('products')
            ->join('order_product','products.id','=','order_product.products_id')
            ->join('orders','orders.id','=','order_product.order_id')
            ->selectRaw('products.*, COALESCE(sum(order_product.order_quantity),0) total')
            ->groupBy(DB::raw('products.id'))
            ->orderBy('total','desc')
            ->whereBetween('orders.created_at', [Carbon::parse($request->fromDate)->toDateTimeString(),Carbon::parse($request->toDate)->toDateTimeString()])
            ->get();

            if ($data->isEmpty()) {
                return redirect()->back()->with('report-empty', 'No data found. Please check FromDate and ToDate');
            }
            return view('Report.reportViewAnnual')->with('data', $data)->with('request', $request);
        }

        // else if($request->report == "OR"){
        //     $data = Order::with('users','deliveries','invoices')->whereBetween('created_at', [Carbon::parse($request->fromDate)->toDateTimeString(),Carbon::parse($request->toDate)->toDateTimeString()])->get();
        //
        //     if($data->isEmpty()){
        //         return redirect()->back()->with('report-empty', 'No data found. Please check FromDate and ToDate');
        //     }
        //
        //     return view('Report.reportViewOrders')->with('data',  $data)->with('request', $request);
        // }
        else if($request->report == "OR"){
            $data = PurchasingOrder::with('purchasing_order_products')->whereBetween('created_at', [Carbon::parse($request->fromDate)->toDateTimeString(),Carbon::parse($request->toDate)->toDateTimeString()])->get();

            if($data->isEmpty()){
                return redirect()->back()->with('report-empty', 'No data found. Please check FromDate and ToDate');
            }

            return view('Report.reportViewOrders')->with('data',  $data)->with('request', $request);
        }

        else if($request->report == "PR"){
            $data = Products::with('orders')->whereBetween('created_at', [Carbon::parse($request->fromDate)->toDateTimeString(),Carbon::parse($request->toDate)->toDateTimeString()])->get();

            if($data->isEmpty()){
                return redirect()->back()->with('report-empty', 'No data found. Please check FromDate and ToDate');
            }

            return view('Report.reportViewProduct')->with('data',  $data)->with('request', $request);
        }

        else if($request->report == "DR"){
            $data = Delivery::with('orders','orders.users','orders.invoices')->whereBetween('created_at', [Carbon::parse($request->fromDate)->toDateTimeString(),Carbon::parse($request->toDate)->toDateTimeString()])->get();

            if($data->isEmpty()){
                return redirect()->back()->with('report-empty', 'No data found. Please check FromDate and ToDate');
            }

            return view('Report.reportViewDelivery')->with('data',  $data)->with('request', $request);
        }

    }



    function printReport($report, $fromDate, $toDate){

        if($report == "SR"){

            $data = Order::with('products','orders.invoices')->whereBetween('created_at', [Carbon::parse(str_replace("-", "/", $fromDate))->toDateTimeString(),Carbon::parse(str_replace("-", "/", $toDate))->toDateTimeString()])->get();

            $reportData = [
                'data' => $data,
                'fromDate' => $fromDate,
                'toDate' => $toDate
            ];

            return view('Report.reportViewSales')->with('data',$data)->with('fromDate',$fromDate)->with('toDate',$toDate);
        }

        elseif ($report == "AR"){
            $data = Order::with('products','invoices')->whereBetween('created_at', [Carbon::parse(str_replace("-", "/", $fromDate))->toDateTimeString(),Carbon::parse(str_replace("-", "/", $toDate))->toDateTimeString()])->get();

            $reportData = [
                'data' => $data,
                'fromDate' => $fromDate,
                'toDate' => $toDate
            ];

            return view('Report.reportViewAnnual')->with('data',$data)->with('fromDate',$fromDate)->with('toDate',$toDate);
        }

        else if($report == "OR"){
            $data = Order::with('users','deliveries','invoices')->whereBetween('created_at', [Carbon::parse(str_replace("-", "/", $fromDate))->toDateTimeString(),Carbon::parse(str_replace("-", "/", $toDate))->toDateTimeString()])->get();

            $reportData = [
                'data' => $data,
                'fromDate' => $fromDate,
                'toDate' => $toDate
            ];

            return view('Report.reportViewOrders')->with('data',$data)->with('fromDate',$fromDate)->with('toDate',$toDate);
        }
        else if($report == "PR"){
            $data = Products::with('orders')->whereBetween('created_at', [Carbon::parse(str_replace("-", "/", $fromDate))->toDateTimeString(),Carbon::parse(str_replace("-", "/", $toDate))->toDateTimeString()])->get();

            $reportData = [
                'data' => $data,
                'fromDate' => $fromDate,
                'toDate' => $toDate
            ];

            return view('Report.reportViewProduct')->with('data',$data)->with('fromDate',$fromDate)->with('toDate',$toDate);
        }
        else{
            $data = Delivery::with('orders','orders.users','orders.invoices')->whereBetween('created_at', [Carbon::parse(str_replace("-", "/", $fromDate))->toDateTimeString(),Carbon::parse(str_replace("-", "/", $toDate))->toDateTimeString()])->get();

            $reportData = [
                'data' => $data,
                'fromDate' => $fromDate,
                'toDate' => $toDate
            ];

            return view('Report.reportViewDelivery')->with('data',$data)->with('fromDate',$fromDate)->with('toDate',$toDate);
        }

    }
}
