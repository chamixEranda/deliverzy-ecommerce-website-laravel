@extends('layouts.admin')

@section('title', 'AddProducts - ')

@section('content')
<div class="container col-lg-4 dash-text mt-4">
    <h1 style="font-weight:lighter;"> ADD NEW ITEM</h1>
</div><br>



<!-- <div class="container">
  <div class="row">
      <div class="row-cols-md-1">
          <p>gfhdfhdgh</p>
      </div>
  </div>
</div> -->

<div class="container-fluid col-lg-5">

    <div class="orders">
        <div class="row my-">
            <!-- <div class="col" > -->
            <form action="{{ route('admin.storeproduct') }}" method="POST" autocomplete="off" enctype="multipart/form-data">

                @csrf

                <div class="form-row">
                    <label for=""style="font-weight:bold;">Supplier*</label>
                    <select class="form-select mt-3 mb-4" name="supplier" aria-label="Default select example"style="height: 50px;width: 800px;">
                        <option value="" selected>Select Supplier</option>
                        @foreach ($supplier as $oneSupplier)
                        <option value="{{ $oneSupplier->id }}">{{ $oneSupplier->company_name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">@error('supplier'){{ $message }}@enderror</span>
                </div>

                <div class="form-row">
                    <div class="">
                        <label for="" style="font-weight:bold;">Item ID*</label>
                        <input type="text" class="form-control  my-3 " name="id" value="{{ $maxid }}"  style="height: 50px;width: 800px; " readonly>
                    </div>
                </div>

                <div class="form-row">
                    <div class="">
                        <label for=""style="font-weight:bold;">Item Name*</label>
                        <input type="text" class="form-control  my-3 " name="itemname" style="height: 50px;width: 800px;">
                        <span class="text-danger">@error('itemname'){{ $message }}@enderror</span>
                    </div>
                </div>

                <div class="form-row">
                    <label for=""style="font-weight:bold;">Category*</label>
                    <select class="form-select mt-3 mb-4" name="category" aria-label="Default select example"style="height: 50px;width: 800px;">
                        <option value="" selected>Select Category</option>
                        <option value="Beverages">Beverages</option>
                        <option value="Dry Rations">Dry Rations</option>
                        <option value="Fruits">Fruits</option>
                        <option value="Vegetables">Vegetables</option>
                        <option value="Grocery">Grocery</option>
                        <option value="Backery">Backery</option>
                        <option value="Chilled">Chilled</option>
                        <option value="Meat & SeaFood">Meat & SeaFood</option>
                        <option value="Others">Others</option>
                    </select>
                    <span class="text-danger">@error('category'){{ $message }}@enderror</span>
                </div>



                <div class="form-row">
                    <div class="">
                        <label for=""style="font-weight:bold;">Price*</label>
                        <input type="text" class="form-control  mt-3 mb-4" name="price" style="height: 50px;width: 800px;">
                        <span class="text-danger">@error('price'){{ $message }}@enderror</span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="">
                        <label for=""style="font-weight:bold;">Quantity*</label>
                        <input type="text" class="form-control  mt-3 mb-4" name="quantity" style="height: 50px;width: 800px;">
                        <span class="text-danger">@error('quantity'){{ $message }}@enderror</span>
                    </div>
                </div>

                <label for=""style="font-weight:bold; margin-bottom: 15px;">Image*</label>
                <div class="input-group mb-3 ">

                <input type="file" name="imagepath" class="form-control" id="inputGroupFile01" onchange="getImagePreview(event)">
                </div>
                <div id="previewAdd"></div>

                <div class="container col-lg-3">
                    <button type="submit" class="btn bg-dark product-btn" style="width: 150px;"> ADD</button>
                </div>

            </form>

        </div>


    </div>
</div><br>
@endsection
