@extends('layouts.app')

@section('title', 'My-Cart - ')
    
@section('content')
@php $subTotal = 0 ;@endphp
<div class="container pt-5 ms-0">
    <h1 class="text mt-5">Cart</h1>
</div>
@if (Session::get('stockError'))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('stockError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
 @endif


  {{-- delete confirmation --}}
<div class="modal fade" id="cartDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title deleteTitle" id="staticBackdropLabel">Remove cart item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <strong class="deleteMessage">Are you sure that you want to remove this product from cart?</strong> 
                <form  method="POST" id="cartdeleteForm" class="mt-3"> 
                    @csrf
                    @method('delete')
                    <div class="modal-footer">
                        <button type="submit" class="btn btn   btn-md rounded-0 ps-4 pe-4 adminOptionBtn" style="background: #43f32c; font-weight:bold; color: #fff;">YES</button>
                        <button type="reset" class="btn btn   btn-md rounded-0 ps-4 pe-4 adminOptionBtn" style="background: #43f32c; font-weight:bold; color: #fff;" data-bs-dismiss="modal">NO</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- delete confirmation end --}}

      {{--  alerts--}}
      
      <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </symbol>
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
          <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
          <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </symbol>
      </svg>
    <div class="row m-3">
            @if (Session::get('cartRemoveSuccess'))
                <div class="row" >
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    {{ Session::get('cartRemoveSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

        @if (Session::get('cartAddSuccess'))
            <div class="row">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    {{ Session::get('cartAddSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if (Session::get('cartUpdateSuccess'))
            <div class="row">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                {{ Session::get('cartUpdateSuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if (Session::get('cartEmpty'))
            <div class="row">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    {{ Session::get('cartEmpty') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
    </div>
        
    
<div data-aos="fade-down">
    <div class="row m-3">
        <div class="table-responsive-md">
            <form action="{{ route('user.updateCart') }}" method="POST" autocomplete="off" id="cart-update-form">
                @csrf
            
                <table class="table  cartTables text-wrap" id="cartTableMain">
                    <thead>
                        <tr>
                            <th scope="col" colspan="2" class="text-start">Product details</th>
                            <th scope="col " class="text-start">Quantity</th>
                            <th scope="col" class="text-start"> Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (Auth::user()->carts->products as $oneproduct)
                        <tr>
                            <td class="d-none">{{ $oneproduct->pivot->id}}</td>
                            <td class="cart-tb-image-column col-md-1">
                                <a href="{{ route('ShowProduct',$oneproduct->id) }}" class="text-decoration-none"><img class="border cart-td-image" src="{{ asset('productImages/'.$oneproduct->imagepath) }}"
                                width="150" height="100"></a>
                            </td>
                            <td class="cart-td-content">
                                <h5 class="mb-1">{{ $oneproduct->name }}</h5>
                                @if ($oneproduct->quantity<=0)
                                    <span class="badge bg-success rounded-0 cart-out-stocktage mb-1">Out of stock</span>
                                @else
                                    <span class="badge bg-success rounded-0 cart-stocktage mb-1">In stock</span>
                                @endif
                                
                            </td>
                            <td class="cart-td-quntity">
                                <input type="hidden" name="cart_product_id[]" value="{{ $oneproduct->pivot->id }}">
                                <input type="number" name="quantity[]" class="form-control rounded-0 text-center cart-quantity" 
                                min="1" max="{{ $oneproduct->quantity }}" value="{{ $oneproduct->pivot->quantity  }}" style="width: 100px;">
                                {{-- <h5 class="quntity"> {{ $oneproduct->pivot->quantity }}</h5> --}}
                            </td>
                            <td class="cart-td-total"> 
                                <h5>Rs. {{ number_format($oneproduct->price * $oneproduct->pivot->quantity) }}</h5>
                            </td>
                            <td>
                                <a id="cartTrashbutton"  class="text-decoration-none cart-items-DropIcon cartTrashbutton" style="cursor: pointer;"><i class="bi bi-x-circle-fill"></i></a>
                            </td>
                        </tr>
                        @php $subTotal = $subTotal + $oneproduct->price * $oneproduct->pivot->quantity @endphp
                        
                        @empty
                        <td colspan="10" class="cart-td-content text-center" style="color: red;"><h4>Your Cart is Empty</h4></th>
                            <img src="{{ asset('images/sorry.svg') }}" alt="" class="img-fluid mb-4" style="width: 7rem;"><br>
                            <a href="{{ route('Categories') }}" class="btn btn-success rounded-0 ps-5 pe-5">Go to Menu</a>
                        @endforelse
                    </tbody>
                </table>
                <div class="text-center">
                    @if (!is_null(Auth::user()->carts->products->first()))
                    <button type="submit" class="btn btn-primary rounded-0 ps-5 pe-5 cart-summery-btn" 
                    id="cart-update-btn" disabled>UPDATE CART</button>
                    @endif
                </div>
            </form>
        </div>
    </div>   
    
    
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="cart-box p-5" style="background: #FFF">
                    <h3 class="mb-3 summary">Cart Summery</h3>
                    <table class="table table-borderless cart-summery-Tables" id="cartTableMain">
                        <tbody>
                            <tr>
                                <td>Sub Total</th>
                                <td class="cart-summery-Tables-data">Rs.{{ number_format($subTotal) }}</td>
                            </tr>
                            <tr>
                                <td>Tax {{ env('TAX_RATE') }}%</td>
                                <td class="cart-summery-Tables-data">Rs.{{ number_format(($subTotal - ($subTotal * env('DISCOUNT_RATE') / 100)) * env('TAX_RATE') / 100) }}</td>
                            </tr>
                            <tr>
                                <td>Amount discounted {{ env('DISCOUNT_RATE') }}%</td>
                                <td class="cart-summery-Tables-data"> Rs.{{ number_format( $subTotal * env('DISCOUNT_RATE') / 100 ) }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td>Grand Total</td>
                                <td class="cart-summery-Tables-data">Rs.{{ number_format(($subTotal  - ($subTotal * env('DISCOUNT_RATE') / 100 )) +
                                 (($subTotal - ($subTotal * env('DISCOUNT_RATE') / 100)) * env('TAX_RATE') / 100)) }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-center mt-5">
                        <a href="{{ route('user.Checkout') }}"><button class="btn  rounded-0 cart-placeordr-btn  ps-4 pe-4">PROCEED TO CHECKOUT</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script>
        // delete review
        $(document).ready(function (){
          $('#cartTableMain').on('click','.cartTrashbutton',function(){ 
              $tr = $(this).closest('tr');
              var data = $tr.children("td").map(function() {
                  return $(this).text();
              }).get();

              console.log(data[0]);

              $('#cartdeleteForm').attr('action', '/user/cart/'+ data[0]); 
              $('#cartDeleteModal').modal('show');
          });
        });
        // delete review end
        
        // cart update  btn
    $(document).ready(function() {
      $('#cart-update-form').on('input change', function() {
        $('#cart-update-btn').attr('disabled', false);
      });
    })
</script>

@endsection