@extends('layouts.admin')

@section('content')

<div class="container col-lg-4 dash-text mt-4">
    <h1 style="font-weight: lighter">SUPPLIERS</h1>
</div>
 

<div class="container-fluid  col-lg-5  px-4">

    @if (Session::get('successAddItem'))
        <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
            {{ Session::get('successAddItem') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (Session::get('fail'))
        <div class="alert alert-danger">
            {{ Session::get('fail') }}
        </div>
    @endif


    <div class="row  g-4 my-3">
        <div class=" spReg-btn ">
           <a href="{{ route('admin.RegisterSupplier') }}" ><button type="button" class="btn sup-btn btn-lg  spReg-btn"><i class="fas fa-plus-square"></i> REGISTER</button></a> &nbsp;&nbsp;&nbsp;
           {{-- <a href="{{ route('admin.RequestOrder') }}" ><button type="button" class="btn sup-btn btn-lg  spReg-btn"><i class="fas fa-plus-square"></i> PURCHASING REQUEST</button></a> --}}
           {{-- <a href="#" ><button type="button" class="btn sup-btn btn-lg  spReg-btn"><i class="fas fa-plus-square"> ADD PRODUCTS</button></a> --}}
        </div>

    </div>
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
                            <th scope="col ">COMPANY EMAIL</th>
                            <th scope="col ">REGISTERED DATE</th>
                            <th scope="col">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($supplier as $onesupplier)
                        <tr>
                            <th scope="row">{{ $onesupplier->id }}</th> 
                            <td>{{ $onesupplier->company_name }}</td>
                            <td>{{ $onesupplier->company_email }}</td>
                            <td>{{ $onesupplier->created_at }}</td>
                            <td><a href="" type="button" class="btn btn-info small text-light" value="View">
                                <i class="fas fa-fw fa-info-circle"></i>View</a>
                                <a href="" type="button" class="btn btn-danger small text-light">
                                <i class="bi bi-exclamation-circle-fill"></i> Delete</a>
                            </td>
                        </tr>
                        @endforeach
                      
                    </tbody>
                </table>
            </div>
        </div>
     

    </div>
</div>
@endsection