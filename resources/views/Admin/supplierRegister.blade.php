@extends('layouts.admin')

@section('content')
<div class="container-fluid col-lg-4 dash-text mt-4">
    <h4>Register Suppliers</h4>
</div><br>

<div class="container-fluid col-lg-5">

    <div class="orders">
        <div class="row my-5">
            <!-- <div class="col" > -->
            <form action="{{ route('admin.sotresupplier') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="">
                        <h5>Supplier ID*</h5>
                        <input type="text" class="form-control  my-3 " name="id" value="{{ $maxid }}" style="height: 50px;width: 800px;" readonly>
                    </div>
                </div>

                <div class="form-row">
                    <div class="">
                        <h5>Company Name</h5>
                        <input type="text" class="form-control  my-3 " name="company_name" style="height: 50px;width: 800px;">
                        <span class="text-danger">@error('company_name'){{ $message }}@enderror</span>
                    </div>
                </div>

        
                {{-- <div class="form-row">
                    <div class="">
                        <h5>Address</h5>
                        <input type="text" class="form-control  my-3 " name="sup_address" style="height: 50px;width: 800px;">
                    </div>
                </div> --}}
                

                <div class="form-row">
                    <div class="">
                        <h5>Company Email</h5>
                        <input type="email" class="form-control  my-3 " name="company_email" style="height: 50px;width: 800px;">
                        <span class="text-danger">@error('company_email'){{ $message }}@enderror</span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="">
                        <h5>Contact Number</h5>
                        <input type="text" class="form-control  my-3 " name="contact" style="height: 50px;width: 800px;">
                        <span class="text-danger">@error('contact'){{ $message }}@enderror</span>
                    </div>
                </div>
              

                <div class="container col-lg-3">
                    <button type="submit" class="btn bg-dark editeproduct-btn" style="color: #fff;">Register</button>
                </div>

            </form>

        </div>


    </div>
</div><br>

@endsection