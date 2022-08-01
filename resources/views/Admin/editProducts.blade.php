@extends('layouts.admin')

@section('title','EditProducts - ')
    
@section('content')
<div class="container col-lg-4 dash-text mt-4">
    <h1 style="font-weight:lighter;"> UPDATE ITEM</h1>
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
            <form action="{{ route('admin.updateproduct',$product->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                    <div class="">
                        <label for=""style="font-weight:bold;">Supplier*</label>
                        <input type="text" class="form-control  my-3 " name="supplier" value="{{ $product->supplier_id }}" style="height: 50px;width: 800px;" readonly>
                    </div>
                </div>

                <div class="form-row">
                    <div class="">
                        <label for="" style="font-weight:bold;">Item ID*</label>
                        <input type="text" class="form-control  my-3 " name="id" value="{{ $product->id }}" style="height: 50px;width: 800px; " readonly>
                    </div>
                </div>

                <div class="form-row">
                    <div class="">
                        <label for=""style="font-weight:bold;">Item Name*</label>
                        <input type="text" class="form-control  my-3 " name="itemname" value="{{ $product->name }}" style="height: 50px;width: 800px;">
                        <span class="text-danger">@error('itemname'){{ $message }}@enderror</span>
                    </div>
                </div>

                <div class="form-row">
                <label for=""style="font-weight:bold;">Category*</label>
                    <select class="form-select mt-3 mb-4" name="category" aria-label="Default select example"style="height: 50px;width: 800px;">
                        {{-- <option value="">Select Category</option> --}}
                        <option @if ($product->category == 'Beverages')selected @endif value="Beverages">Beverages</option>
                        <option @if ($product->category == 'Dry Rations')selected @endif value="Dry Rations">Dry Rations</option>
                        <option @if ($product->category == 'Fruits')selected @endif value="Fruits">Fruits</option>
                        <option @if ($product->category == 'Vegetables')selected @endif value="Vegetables">Vegetables</option>
                        <option @if ($product->category == 'Grocery')selected @endif value="Grocery">Grocery</option>
                        <option @if ($product->category == 'Backery')selected @endif value="Backery">Backery</option>
                        <option @if ($product->category == 'Chilled')selected @endif value="Chilled">Chilled</option>
                        <option @if ($product->category == 'Meat & SeaFood')selected @endif value="Meat & SeaFood">Meat & SeaFood</option>
                        <option @if ($product->category == 'Others')selected @endif value="Others">Others</option>
                    </select>
                     <span class="text-danger">@error('category'){{ $message }}@enderror</span>
                </div>

                <div class="form-row"> 
                    <div class="">
                        <label for=""style="font-weight:bold;">Price*</label>
                        <input type="text" class="form-control  mt-3 mb-4" name="price" value="{{ $product->price }}" style="height: 50px;width: 800px;">
                        <span class="text-danger">@error('price'){{ $message }}@enderror</span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="">
                        <label for=""style="font-weight:bold;">Quantity*</label>
                        <input type="text" class="form-control  mt-3 mb-4" name="quantity" value="{{ $product->quantity }}" style="height: 50px;width: 800px;">
                        <span class="text-danger">@error('quantity'){{ $message }}@enderror</span>
                    </div>
                </div>

                <label for=""style="font-weight:bold; margin-bottom: 15px;">Image*</label>
                 <div id="previewEdit"><img src="{{ asset('productImages/'.$product->imagepath) }}" alt="" width="300px" height="300px"></div>
                <div class="input-group mb-3 ">   
                    <input type="file" class="form-control" name="imagepath" id="inputGroupFile01" onchange="getImageEdit(event)">
                </div>

                <div class="container col-lg-3 mb-3">
                    <button type="submit" class="btn bg-dark product-btn" style="width: 150px;"> UPDATE</button>
                </div>

            </form>

        </div>


@endsection