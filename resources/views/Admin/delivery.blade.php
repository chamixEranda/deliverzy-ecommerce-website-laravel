@extends('layouts.admin')

@section('title', 'Delivery - ')
    
@section('content')
      <div class="container col-lg-4 dash-text mt-4">
        <h4>DELIVERIES</h4>
    </div>


    <div class="container-fluid col-lg-5" >

        <div class="orders">
            <div class="row my-5">
                <div class="col" >
                    <table class="table bg-white rounded shadow-sm  table-hover "style="width: 160%">
                        <thead>
                            <tr>
                                <th scope="col ">DELIVERY ID</th>
                                <th scope="col ">ORDER ID</th>
                                <th scope="col ">PAYMENT METHOD</th>
                                <th scope="col ">DELIVER STATUS</th>
                                <th scope="col ">UPDATE DATE</th>
                                <th scope="col">ACTION</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deliveries as $oneDelivery)
                                
                            
                            <tr>
                                <th scope="row">{{ $oneDelivery->id }}</th> 
                                <td>{{ $oneDelivery->order_id }}</td>
                                <td>@if ($oneDelivery->orders->payment_method == 'C')
                                    Cash on Deliver
                                    @endif
                                </td>
                                <td>
                                    @if($oneDelivery->deliver_status == "P")
                                        <span class="badge bg-warning myOrder-badge-pen rounded-0">Pending</span></td>
                                    @elseif($oneDelivery->deliver_status == "Pr")
                                        <span class="badge bg-info myOrder-badge-pro rounded-0">Processing</span>
                                    @elseif($oneDelivery->deliver_status == "C")
                                        <span class="badge bg-success myOrder-badge-com rounded-0">Completed</span>
                                    @else
                                        <span class="badge bg-success myOrder-badge-re rounded-0">Returned</span>
                                    @endif
                                </td>
                                <td>{{ $oneDelivery->created_at }}</td>
                                <td><a href="" type="button" class="btn btn-danger small text-light">
                                    <i class="bi bi-exclamation-circle-fill"></i> Delete</a></td>
                            </tr>
                            @endforeach

                            <!-- <tr>
                                <th scope="row">002</th>
                                <td>kohila 1bundle</td>
                                <td>60/=</td>
                                <td>vegitable</td>
                                <td >12/24/2021</td>
                               <td><a href="#"><i class=" fas fa-edit text-black"></i></a>&nbsp;&nbsp;&nbsp;<a href="#"><i class="fas fa-trash-alt text-black"></i></a></td>
                            </tr> -->

                           
                          
                        </tbody>
                    </table>
                </div>
            </div>
         

        </div>
    </div><br>
@endsection