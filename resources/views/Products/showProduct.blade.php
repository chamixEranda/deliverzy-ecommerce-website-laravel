@extends('layouts.app')

@section('title', 'ShowProduct - ')
    
@section('content')
      <!-- product section -->
  <div class="container-fluid pt-5 mt-5">
    <div class="row gx-2">
      <div class="col-md-6 text-center mb-2 ">
        <div class="img-fluid"> 
          <img src="{{ asset('productImages/'.$product->imagepath) }}" class="img-fluid border border-dark itemImage" width="450">
        </div>
      </div>
      <div class="col-md-6">
        <div class="item-content">
          <div class="instock-tag mb-2"> 
            @if ($product->quantity<=0)
              <span class="badge bg-success rounded-0 cart-out-stocktage mb-1">Out of stock</span>
            @else
              <span class="badge bg-success rounded-0 cart-stocktage mb-1">In stock</span>
            @endif
          </div>
          <div class="item-name">
            <h2 class="proItemName m-0">{{ $product->name }}</h2>
          </div>
          <div class="item-category">
            <h5 class="proItemCate">Category - {{ $product->category }}</h5>
          </div>
          <div class="item-price mb-3">
            <h5 class="proItemPrice extraPriceMar">Rs.{{ number_format($product->price) }}.00</h5>
          </div>
          <form action="{{ route('user.addToCart') }}" class="row g-3" method="POST" autocomplete="off">
            @csrf
            <div class="col-md-12">           
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group" role="group" aria-label="First group">
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="stock-label">
                <h6 class="proItemStockQu m-0 extraStockMar">{{ $product->quantity }} in stock</h6>
              </div>
            </div>
            <div class="col-md-5 input-group-lg">
              <input type="hidden" name="products_id" id="products_id"value="{{ $product->id }}">
              <input type="hidden" name="products_name" id="products_name"value="{{ $product->name }}">
              <input type="hidden" name="product_quantity" id="product_quantity" value="{{ $product->quantity }}">

              @auth
              <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
              @endauth
              <input type="number" value="0" name="quantity" class="form-control rounded-0 proItemQuantity @error('quantity') is-invalid invalidQuantity 
              @enderror" id="quantityinputBox" min="1" max="{{ $product->quantity }}" @if($product->quantity == 0) @endif>
            </div><br>
            <div class="col-md-6 d-grid">
              <button class="btn btn-primary rounded-0 btn-lg proAddtoCartbtn  @if($product->quantity == 0) proAddtoCartbtn-noStock @endif" type="submit" @if($product->quantity == 0)  @endif type="submit">ADD TO CART</button>
            </div>
          </form>

          <span class="text-danger">@error('quantity'){{ $message }}@enderror</span>
          <div class="add-wishlist mt-3 extraWishMar">
            <form action="">
              <div class="col-md-12"><br>
                <div class="add-wishlist align-middle extraWishMar">
                  @auth
                        @if(in_array($product->id, Auth::user()->wishlists->products->pluck('id')->toArray()))
                          <a class="proAddToCartlink" href="{{ route('user.removeFromWishlist',['product_id' => $product->id, 'user_id' => Auth::user()->id]) }}"
                          onclick="event.preventDefault();document.getElementById('wishlistRemovecard-form').submit();"><i class="bi bi-heart-fill me-2 proAddtowishList "></i>REMOVE FROM WISHLIST
                          <form action="{{ route('user.removeFromWishlist',['product_id' => $product->id, 'user_id' => Auth::user()->id]) }}" method="POST" id="wishlistRemove-form" class="d-none">@method('delete')@csrf</form></a>
                        @else
                          <a class="proAddToCartlink" href="{{ route('user.addToWishlist',['product_id' => $product->id, 'user_id' => Auth::user()->id]) }}" onclick="event.preventDefault();document.getElementById('wishlistAdd-form').submit();"><i class="bi bi-heart me-2 proAddtowishList" ></i>
                          ADD TO WISHLIST<form action="{{ route('user.addToWishlist',['product_id' => $product->id, 'user_id' => Auth::user()->id]) }}" method="POST" id="wishlistAdd-form" class="d-none">@method('post')@csrf</form></a>   
                        @endif
                          @else
                          <a class="proAddToCartlink" href="{{ route('user.Login') }}"><i class="bi bi-heart me-2 proAddtowishList "></i>ADD TO WISHLIST</a> 
                  @endauth
                  
                </div>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>


  {{-- <div class="container mt-5 mb-5">
    <div class="row">
      <div class="col-md-12 text-center">
        <h2 class="relatedProductHeading">Related products</h2>
      </div>
     
          <div class="col-md-2 mt-4 ms-4 ">
            <div class="card topPick-card" style="box-shadow: 0px 0px 20px 0px rgb(0 0 0 / 10%);cursor: pointer;">
              <a href="#"><i class="far fa-heart heart mt-3 "></i></a>
              <img src="{{ asset('images/Maliban Chick Bits.png') }}" class="card-img-top"
                  height="110px">

              
              <div class="card-body">
                  <h6 class="card-title">{{ $item->name }}</h6>
                  <p class="card-text">Rs.270.00/kg</p>

                  <div class="cart ">
                      <a href="#"><i class="bi bi-cart-plus-fill"></i></a>
                  </div>
              </div>
            </div>
          </div>
        
      </div>
    </div> --}}

<section id="reviewSection">
  <div class="container mt-5 mb-3">
    <div class="row">
      <div class="col-md-12 text-center">
        <h2 class="relatedProductHeading">Customer Reviews</h2>
      </div>
    </div>
  </div>

  <div class="container">
    @if (Session::get('success-add'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('success-add') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
  </div>

  <div class="container">
    <div class="row">
      @forelse ($product->reviews as $oneReview)
      <hr class="reviewDivider">
      <div class="col-md-6">
        <div class="profile text-end">
          <div class="text-center">
            <span class="dot"><span class="profileName">{{ $oneReview->user->firstname[0].$oneReview->user->lastname[0] }}</span></span>
            <h5 class="ReviewcustomerName">{{ $oneReview->user->firstname.''.$oneReview->user->lastname }}</h5>
            <h5 class="ReviewcustomerEmail">{{ $oneReview->user->email }}</h5>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="reviewContent">
          <div class="reviewItemName proItemReviewContent">
            <h5 class="reviewProName">{{ $product->name }}</h5>
            <div class="ratingStars d-inline">
              @for ($i = 0; $i < $oneReview->rating; $i++)
                <i class="bi bi-star-fill"></i>
              @endfor
              @for ($i = 0; $i < 5-$oneReview->rating; $i++)
                    <i class="bi bi-star"></i>
              @endfor
            </div>
            <div class="reviewBody mt-2">
              <p class="reviewmessage">{{ $oneReview->comment }}</p>
            </div>
          </div>
        </div>
      </div>
    </div> 
    @empty
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-center">
                <h4 class="NorelatedProductHeading">No reviews</h4>
            </div>
        </div>  
  </div>
  @endforelse
  <div class="container mt-5 mb-5" id="writeReview">
    <div class="row">
      <div class="col-mb-12 text-center">
        @auth
          <a href="{{ route('user.createReview',$product->id) }}" class="btn btn-primary btn-lg ps-5 pe-5 mb-2 rounded-0 proWriteReview">Write Review</a>
        @else
        <a href="{{ route('user.Login') }}" class="btn btn-primary btn-lg ps-5 pe-5 mb-2 rounded-0 proWriteReview">Write Review</a>
        @endauth      
      </div>
    </div>
  </div>
  </div>
</section>
@endsection