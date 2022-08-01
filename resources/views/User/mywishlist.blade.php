@extends('layouts.app')

@section('title', 'My-wishlist - ')
    
@section('content')
<div class="container pt-5">
    <h1 class="text mt-5">Wishlist</h1>
</div>

@if (Session::get('cartEmpty'))
    <div class="row">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ Session::get('cartEmpty') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                <strong class="deleteMessage">Are you sure that you want to remove this product from wishlist?</strong> 
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


<div class="row" data-aos="fade-down"data-aos="fade-down">
    <div class="table-responsive-md"> 
        <table class="table cartTables text-wrap" id="cartTableMain">
            <tbody>
                @forelse (Auth::user()->wishlists->products as $oneproduct)
                <tr>
                    <td class="cart-tb-image-column col-md-2">
                        <a href="{{ route('ShowProduct',$oneproduct->id) }}"><img src="{{ asset('productImages/'.$oneproduct->imagepath) }}" width="150" height="110"></a>
                    </td> 
                    <td class="cart-td-content">
                        <h5 class="mb-1">{{ $oneproduct->name }}</h5>
                        @if ($oneproduct->quantity<=0)
                            <span class="badge bg-success rounded-0 cart-out-stocktage mb-1">Out of stock</span>
                        @else
                            <span class="badge bg-success rounded-0 cart-stocktage mb-1">In stock</span>
                        @endif  
                        <h6 class="price">Rs: {{ $oneproduct->price }}</h6>
                        <a href="{{ route('ShowProduct',$oneproduct->id) }}" class="wish-cart"><i class="bi bi-cart-plus-fill toCart"></i>Add to cart</a> 
                    </td>  
                    <td>
                        <a id="cartTrashbutton"  class="text-decoration-none cart-items-DropIcon cartTrashbutton" style="cursor: pointer;"><i class="bi bi-x-circle-fill"></i></a>
                    </td>                                         
                </tr>
                @empty
                        <div class="text-center mt-5 mb-5">
                            <h4 style="color: red;">Your Wishlist is Empty</h4>
                            <img src="{{ asset('images/sorry.svg') }}" alt="" class="img-fluid" style="width: 7rem;">
                        </div>
                @endforelse
            </tbody>
        </table>
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

              $('#cartdeleteForm').attr('action', '/user/my-wishlist/'+ data[0]);
              $('#cartDeleteModal').modal('show');
          });
        });
        // delete review end
    </script>
@endsection