@extends('layouts.admin')

@section('title', 'RequestOrder - ')

@section('content')
<div class="container-fluid col-lg-4 dash-text mt-4">
    <h4>New Supply Order</h4>
</div><br>

<div class="container-fluid col-lg-5">

    <div class="orders">
        <div class="row my-5">
            <!-- <div class="col" > -->
            <form action="{{ route('admin.storepurchase') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="">
                        <h5>Purchase Order ID*</h5>
                        <input type="text" class="form-control  my-3 " name="id" value="{{ $maxid }}" style="height: 50px;width: 800px;" readonly>
                    </div>
                </div>

                <div class="form-row">
                    <h5>Supplier*</h5> 
                    <select class="form-select mt-3 mb-4" name="supplier" aria-label="Default select example"style="height: 50px;width: 800px;">
                        <option value="" selected>Select Supplier</option>
                        @foreach ($supplier as $oneSupplier)
                        <option value="{{ $oneSupplier->id }}">{{ $oneSupplier->company_name }}, {{ $oneSupplier->company_email }}</option>
                        @endforeach      
                    </select>
                    <span class="text-danger">@error('supplier'){{ $message }}@enderror</span>
                </div>

                <div id="example-1" class="content " data-mfield-options='{"section": ".group","btnAdd":"#btnAdd-1","btnRemove":".btnRemove"}'>
                    <div class="row mb-3">
                        <div class="col-md-12"><button type="button" id="btnAdd-1" class="btn bg-dark editeproduct-btn" style="color: #fff">Request Products</button></div>
                    </div>
                    <div class="row group mb-3">
                        <div class="col-md-5 ">
                            <input class="form-control" type="text" placeholder="Product Name" name="productname[]" required>
                        </div>
                        <div class="col-md-3">
                            <input class="form-control" type="number" min="1" placeholder="Qty" name="quantity[]" required>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-danger btnRemove">Remove</button>
                        </div>
                    </div>
                </div>
        
                <div class="form-row">
                    <div class="">
                        <h5>Description (optional)</h5>
                        <textarea name="description" id="" cols="60" rows="5"></textarea>
                    </div>
                </div>
                

                <div class="container col-lg-3 mt-4">
                    <button type="submit" class="btn bg-dark editeproduct-btn"style="color: #fff;width: 10rem;">Request</button>
                </div>

            </form>

        </div>


    </div>
</div><br>
@endsection