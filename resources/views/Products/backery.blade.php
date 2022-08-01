@extends('layouts.app')

@section('title', 'Categories-Backery - ')
    
@section('content')
    <section style="padding-top: 80px">
        <div class="container">
            <h2 class="text">Backery</h2>
        </div>
    
         <!-- card -->
            <div class="container-fluid mb-5 " style="padding-left: 80px;" data-aos="fade-down">
            <div class="row">
                  @foreach ($product as $oneproduct)
                     <div class="col-md-2 mt-4 ms-4 ">             
                        <div class="card index-item">
                            @auth
                                @if (in_array($oneproduct->id,Auth::user()->wishlists->products->pluck('id')->toArray()))
                                    <a href="{{ route('user.removeFromWishlist',['product_id' => $oneproduct->id, 'user_id' => Auth::user()->id]) }}"
                                    onclick="event.preventDefault();document.getElementById('wishlistRemovecard-form{{ $oneproduct->id }}').submit();">
                                    <i class="bi bi-heart-fill heart mt-3"></i>
    
                                    <form action="{{ route('user.removeFromWishlist',['product_id' => $oneproduct->id, 'user_id' => Auth::user()->id]) }}" 
                                    method="POST" id="wishlistRemovecard-form{{ $oneproduct->id }}" class="d-none">@method('delete')@csrf</form></a>
                                @else
                                <a href="{{ route('user.addToWishlist',['product_id' => $oneproduct->id , 'user_id' => Auth::user()->id]) }}" 
                                    onclick="event.preventDefault();document.getElementById('wishlistAddcard-form{{ $oneproduct->id }}').submit();">
                                    <i class="bi bi-heart heart mt-3"></i></a> 
        
                                    <form action="{{ route('user.addToWishlist',['product_id' => $oneproduct->id , 'user_id' => Auth::user()->id]) }}" 
                                    method="POST" id="wishlistAddcard-form{{ $oneproduct->id }}" class="d-none">@method('post')@csrf</form></a> 
                                @endif
                            @else
                                <a href="{{ route('user.Login') }}"><i class="far fa-heart heart mt-3 "></i></a>
                            @endauth                        
                            <a href="{{ route('ShowProduct',$oneproduct->id) }}"><img src="{{ asset('productImages/'.$oneproduct->imagepath) }}" class="card-img-top " height="110px"></a>
                            <div class="card-body">
                                <h6 class="card-title">{{ $oneproduct->name }}</h6>
                                <p class="card-text">Rs.{{ number_format($oneproduct->price) }}.00/kg</p>
    
                                <div class="cart ">
                                    <a href="{{ route('ShowProduct',$oneproduct->id) }}"><i class="fas fa-cart-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div> 
                 @endforeach             
            </div>
        </div>
    
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-center">
                        {{ $product->links(); }}
                    </div>
                </div>
            </div>
        </div>
    </section>
     
@endsection