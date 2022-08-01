@extends('layouts.admin')

@section('title ', 'PurchasingRequest - ')
    
@section('content')

<div class="container col-lg-4 dash-text mt-4">
    <h1 style="font-weight: lighter">PURCHASE SUPPLY ORDER</h1>
</div>

<div class="container-fluid  col-lg-5  px-4">
    <div class="row  g-4 my-3">
        <div class=" spReg-btn ">
        <a href="{{ route('admin.RequestOrder') }}" ><button type="button" class="btn sup-btn btn-lg  spReg-btn"><i class="fas fa-plus-square"></i> PURCHASING REQUEST</button></a>
        </div>

    </div>

    @if (Session::get('success'))
        <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (Session::get('fail'))
        <div class="alert alert-danger">
            {{ Session::get('fail') }}
        </div>
    @endif

</div>

<div class="col-lg-8">

    <div class= "order-details">
        <div class="row my-5">
            <div class="col" >
                <table class="table bg-white rounded shadow-sm  table-hover table-responsive-lg supsummary-tbl ">
                    <thead>
                        <tr>
                            <th scope="col ">SUPPLIER ID</th>
                            <th scope="col ">COMPANY NAME</th>
                            <th scope="col ">PO ID</th>
                            <th scope="col ">REQUESTED DATE</th>
                            <th scope="col">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchasingorder as $oneOrder)
                        <tr>
                            <th scope="row">{{ $oneOrder->supplier_id }}</th> 
                            <td>{{ $oneOrder->suppliers->company_name }}</td>
                            <td>{{ $oneOrder->id }}</td>
                            <td>{{ $oneOrder->created_at }}</td>
                            <td>
                                <a href="{{ route('admin.showPurchaseOrder',$oneOrder->id) }}" type="button" class="btn btn-info small text-light" value="View">
                                    <i class="fas fa-fw fa-info-circle"></i>View</a></td>
                        </tr>
                        @endforeach
                      
                    </tbody>
                </table>
            </div>
        </div>
     

    </div>
</div>
@endsection