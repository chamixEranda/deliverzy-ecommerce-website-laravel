@extends('layouts.admin')

@section('content')
<div class="container col-lg-4 dash-text mt-4">
    <h4> VIEW ORDERS</h4>
</div>


<div class="row">
    <div class="col-lg-4">
        <form action="" method="POST" autocomplete="off">
            <table class="table table-borderless adminOrderViewTables">
                <tbody>
                    <tr>
                        <td><b>Order No</b></th>
                        <td class="adminOrderViewTable-data">{{ $orders->id }}</td>
                    </tr>
                    <tr>
                        <td><b>Ordered Date</b></td>
                        <td class="adminOrderViewTable-data">{{ $orders->created_at }}</td>
                    </tr>
                    <tr>
                        <td><b>Status</b>
                        <td>
                        @if($orders->deliveries->deliver_status == "P")
                            <span class="badge bg-warning myOrder-badge-pen rounded-0">Pending</span></td>
                        @elseif($orders->deliveries->deliver_status == "Pr")
                            <span class="badge bg-info myOrder-badge-pro rounded-0">Processing</span>
                        @elseif($orders->deliveries->deliver_status == "C")
                            <span class="badge bg-success myOrder-badge-com rounded-0">Completed</span>
                        @else 
                            <span class="badge bg-success myOrder-badge-re rounded-0">Returned</span>
                        @endif</td>
                    </tr>
                    <tr>
                        <td><b>Customer Name</b></td>
                        <td class="adminOrderViewTable-data">{{ $orders->users->firstname.' '.$orders->users->lastname }}</td>
                    </tr>
                    <tr>
                        <td><b>Customer Email</b></td>
                        <td class="adminOrderViewTable-data">{{ $orders->users->email }}</td>
                    </tr>
                    <tr>
                        <td><b>Customer Telephone</b></td>
                        <td class="adminOrderViewTable-data">{{ $orders->users->mobile }}</td>
                    </tr>
                    <tr>
                        <td><b>Customer Address</b></td>
                        <td class="adminOrderViewTable-data">{{ $orders->users->home }} {{ $orders->users->street }}, 
                            {{ $orders->users->city }}, {{ $orders->users->province }}</td>
                    </tr>
                </tbody>
            </table>
         </form>
    </div>
    <div class="col-lg-3">
        
            <table class="table table-borderless adminOrderViewTables">
                <tbody>
                    <tr>
                        <td><b>Delivery ID</b></td>
                        <td class="adminOrderViewTable-data">{{ $orders->deliveries->id }}</td>
                    </tr>
                    <tr>
                        <td><b>Invoice No</b></td>
                        <td class="adminOrderViewTable-data">{{ $orders->invoices->id }}</td>
                    </tr>
                    <tr>
                        <td><b>Total Bill</b></td>
                        <td class="adminOrderViewTable-data">Rs.{{ number_format($orders->invoices->total_bill + $orders->invoices->tax_amount) }}.00/=</td>
                    </tr>
                    <tr>
                        <td><b>Payment method</b></td>
                        @if($orders->payment_method == 'C')
                        <td class="adminOrderViewTable-data">Cash on Delivery</td>
                        @endif
                    </tr>
                    <tr>
                        <td><b>Payment Status</b></td>
                        @if($orders->invoices->payment_status == 'P')
                        <td class="adminOrderViewTable-data">Paid</td>
                        @elseif ($orders->invoices->payment_status == 'N')
                        @endif
                    </tr>
                    
                </tbody>
            </table>
            
    </div>
</div>
    <div class="container col-lg-4 dash-text mt-4">
    <h4>ORDERED ITEMS </h4>
</div>

<div class="col-lg-8">

    <div class="order-details">
        <div class="row my-5">
            <div class="col">
                <table class="table bg-white rounded shadow-sm  table-hover table-responsive-lg   view-tbl text-center">
                    <thead>
                        <tr>
                            <th scope="col ">Product id</th>
                            <th scope="col ">Product name</th>
                            <th scope="col ">Quantity</th>
                            <th scope="col ">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders->products as $oneProduct)
                        <tr>
                            <th scope="row">{{ $oneProduct->id }}</th>
                            <td>{{ $oneProduct->name }}</td>
                            <td>{{ $oneProduct->quantity }}</td>
                            <td>{{ number_format($oneProduct->price) }}.00/=</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row justify-content-center mt-4 mb-5">
            <div class="col-lg-12 text-center">
                <a href="{{ route('admin.invoicegenarate',$orders->id) }}" target="_blank" class="btn btn-primary rounded-0 adminOrder-view-btn pt-2 pb-2 pe-4 ps-4">GENERATE INVOICE</a>
            </div>
        </div>

    </div>
</div>
@endsection