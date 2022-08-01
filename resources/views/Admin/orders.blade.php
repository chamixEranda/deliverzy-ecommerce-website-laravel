@extends('layouts.admin')

@section('title', 'Orders - ')
    
@section('content')
    <div class="container col-lg-4 dash-text mt-4">
        <h1 style="font-weight: lighter">ORDERS</h1>
    </div>


    <div class="container-fluid col-lg-5" >

        <div class="orders">
            <div class="row my-5">
                <div class="col" >
                    <table class="table bg-white rounded shadow-sm  table-hover table-responsive-lg"style="width: 160%">
                        <thead>
                            <tr>
                                <th scope="col ">ORDER ID</th>
                                <th scope="col ">PAYMENT METHOD</th>
                                <th scope="col ">ORDER STATUS</th>
                                <th scope="col">TOTAL AMOUNT</th>
                                <th scope="col ">ORDERED DATE</th>
                                <th scope="col">ACTION</th>
                             
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $Oneorder)
                            <tr>
                                <th scope="row">{{ $Oneorder->id }}</th> 
                                <td>
                                    @if ($Oneorder->payment_method == 'C')
                                        Cash on Delivery

                                    @endif
                                <td>
                                    @if ($Oneorder->deliveries->deliver_status == 'P')
                                    <span class="badge bg-warning myOrder-badge-pen rounded-0">Pending</span>
                                    
                                </td>
                                    @elseif($Oneorder->deliveries->deliver_status == "Pr")
                                    <span class="badge bg-info myOrder-badge-pro rounded-0">Processing</span>
                                    @elseif($Oneorder->deliveries->deliver_status == "C")
                                    <span class="badge bg-success myOrder-badge-com rounded-0">Completed</span>
                                    @endif
                                <td>{{ $Oneorder->created_at }}</td>
                                <td>Rs.{{ number_format(($Oneorder->invoices->total_bill - $Oneorder->invoices->discountAmount) + 
                                    $Oneorder->invoices->taxAmount) }}.00/=</td>
                                <td>
                                    <a href="{{ route('admin.ordershow',$Oneorder->id) }}" type="button" class="btn btn-info small text-light" value="View">
                                        <i class="fas fa-fw fa-info-circle"></i>View</a>
                                </td>
                            </tr>   
                                       
                            @endforeach     
                        </tbody>
                    </table>
                </div>
            </div>
         

        </div>
    </div><br>
    {{-- pagination --}}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-center">
                    {{  $orders->links();  }}
                </div>
            </div>
        </div>
    </div>
    {{--end pagination --}}
@endsection