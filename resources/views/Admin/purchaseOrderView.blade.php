@extends('layouts.admin')

@section('content')
<div class="container col-lg-4 dash-text mt-4">
    <h4> REQUESTED ORDER</h4>
</div>


<div class="row"> 
    <div class="col-lg-4">
            <table class="table table-borderless adminOrderViewTables">
                <tbody>
                    <tr>
                        <td><b>PO NO</b></th>
                        <td class="adminOrderViewTable-data">{{ $purchaseorder->id }}</td>
                    </tr>
                    <tr>
                        <td><b>Requested Date</b></td>
                        <td class="adminOrderViewTable-data">{{ $purchaseorder->created_at }}</td>
                    </tr>
                    <tr>
                        <td><b>Supplier ID</b>
                        <td>{{ $purchaseorder->supplier_id }}</td>
                    </tr>
                    <tr>
                        <td><b>Company Name</b></td>
                        <td class="adminOrderViewTable-data">{{ $purchaseorder->suppliers->company_name }}</td>
                    </tr>
                    <tr>
                        <td><b>Company Email</b></td>
                        <td class="adminOrderViewTable-data">{{ $purchaseorder->suppliers->company_email }}</td>
                    </tr>
                     
                    
                </tbody>
            </table>
    </div>
    <div class="col-lg-3">
        
            <table class="table table-borderless adminOrderViewTables">
                <tbody>
                    <tr>
                        <td><b>Description</b></td>
                        @if ($purchaseorder->description)
                        <td class="adminOrderViewTable-data">{{ $purchaseorder->description }}</td>
                        @else
                        <td> - </td>
                        @endif
                        
                    </tr> 
                </tbody>
            </table>
            
    </div>
</div>
    <div class="container col-lg-4 dash-text mt-4">
    <h4>REQUESTED PRODUCTS </h4>
    @if (Session::get('updateSuccsess'))
    <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
        {{ Session::get('updateSuccsess') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
</div>

<div class="col-lg-8">
    <div class="order-details">
        <div class="row my-5">
            <div class="col">
                <form action="{{ route('admin.updatePurchaseOrder') }}" method="POST" autocomplete="off" id="order-update-form">
                    @csrf
                <table class="table bg-white rounded shadow-sm  table-hover table-responsive-lg   view-tbl text-center">
                    <thead>
                        <tr>
                            <th scope="col ">PRODUCT NAME</th>
                            <th scope="col ">ORDERED QUANTITY</th>
                            <th scope="col ">RECIEVED QUANTITY</th>
                            <th scope="col ">RETURNED QUANTITY</th>
                            {{-- <th scope="col ">RECIEVED DATE</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($purchaseorder->purchasing_order_products as $oneOrder)
                        
                        <tr>
                            <input type="hidden" value="{{ $oneOrder->id }}" name="pop_id[]">
                            <th scope="row">{{ $oneOrder->product_name }}</th>
                            <td>{{ $oneOrder->order_qty }}</td>
                            <td>

                                <input type="number" name="recieved_qty[]" class="form-control rounded-0 text-center cart-quantity" 
                                min="0" max="" value="{{ $oneOrder->recieved_qty  }}" required>    
                            </td>
                            <td>
                                <input type="number" name="return_qty[]" class="form-control rounded-0 text-center cart-quantity" 
                                min="0" max="" value="{{ $oneOrder->return_qty  }}" required>   
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>            
                <div class="col-lg-12 mt-3 text-center ms-5">
                    <button type="submit" class="btn btn-primary rounded-0 pt-2 pb-2 pe-4 ps-4 ms-5 adminOrder-view-btn" id="update-btn" disabled>UPDATE</button>
                    <a href="{{ route('admin.GoodRecievedNote',$purchaseorder->id) }}" target="_blank"><button type="button" class="btn btn-primary rounded-0 pt-2 pb-2 pe-4 ps-4  adminOrder-view-btn" id="grn-btn">GENERATE GRN</button></a>
                </div>
            </form>

        </div>
        
       

    </div>
</div>
@endsection

@section('javascript')
    <script>
           // purchase update  btn
    $(document).ready(function() {
      $('#order-update-form').on('input change', function() {
        $('#update-btn').attr('disabled', false);
        $('#grn-btn').attr('disabled', true);
      });
    })
    </script>
@endsection