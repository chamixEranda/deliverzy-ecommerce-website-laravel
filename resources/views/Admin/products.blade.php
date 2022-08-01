@extends('layouts.admin')

@section('title', 'Products - ')
    
@section('content')
<div class="container col-lg-4 dash-text mt-4">
    <h1 style="font-weight: lighter">PRODUCTS</h1>
</div><br>

<div class="container col-lg-5  ">
    <a href="{{ route('admin.createproduct') }}"> <button type="button" class="btn bg-dark product-btn"><i class="fas fa-plus-square"></i>  &nbsp; Add Product</button></a>
</div>

<div class="container-fluid col-lg-5" > 
{{-- add success message --}} 
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

{{-- update success message --}}
    @if (Session::get('successUpdateItem'))
            <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
                {{ Session::get('successUpdateItem') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
    @endif
    @if (Session::get('fail'))
        <div class="alert alert-danger">
            {{ Session::get('fail') }}
        </div>
    @endif

{{-- delete confirmation --}}
    <div class="modal fade" id="trashModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title deleteTitle" id="staticBackdropLabel">Delete Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <strong class="deleteMessage">Are you sure that you want to delete this product?</strong> 
                <form  method="POST" id="deletedeleteForm" class="mt-3"> 
                    @csrf
                    @method('delete')
                    <div class="modal-footer">
                    <button type="submit" class="btn btn btn-md rounded-0 ps-4 pe-4 adminOptionBtn" style="background: #3cbb30; color:#fff;">YES</button>
                    <button type="reset" class="btn btn btn-md rounded-0 ps-4 pe-4 adminOptionBtn" style="background: #3cbb30; color:#fff;" data-bs-dismiss="modal">NO</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>

     @if (Session::get('successDelete'))
        <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
            {{ Session::get('successDelete') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- delete confirmation end --}}

    <div class="order-details">
        <div class="row my-4">
            <div class="col" >
                <table id="itemTableMain" class="table bg-white rounded shadow-sm  table-hover table-responsive-lg" style="width: 160%">
                    <thead>
                        <tr>
                            <th scope="col ">PRODUCT ID</th>
                            <th scope="col ">PRODUCT NAME</th>
                            <th scope="col ">PRICE</th>
                            <th scope="col ">QUANTITY</th>
                            <th scope="col ">CATEGORY</th> 
                            <th scope="col">DATE</th>
                            <th scope="col">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($products as $oneproduct)
                            <tr> 
                            <td scope="row">{{ $oneproduct->id }}</td> 
                            <td>{{ $oneproduct->name }}</td>
                            <td>{{ $oneproduct->price }}.00/=</td>
                            <td>{{ $oneproduct->quantity }}</td>
                            <td>{{ $oneproduct->category }}</td>
                            <td >{{ $oneproduct->created_at }}</td>
                            <td><a href="{{ route('admin.editproduct',$oneproduct->id) }}"><i class=" fas fa-edit text-black"></i></a>&nbsp;&nbsp;&nbsp;<a id="moveTrashbutton" class="text-black text-decoration-none moveTrashbutton"><i class="fas fa-trash-alt actionIcon" style="cursor: pointer; color: red;"></i></a></td>
                        </tr>
                       @endforeach                                             
                    </tbody>
                </table>
            </div>
        </div>
     

    </div>
</div><br>
{{-- pagination --}}
<div class="container">
    <div class="row" style="margin-left: 190px;">
        <div class="col-md-12">
            <div class="d-flex justify-content-center">
                {{  $products->links();  }}
            </div>
        </div>
    </div>
</div>
{{--end pagination --}}
@endsection

@section('javascript')
    <script>
    // delete items
    $(document).ready(function (){
        $('#itemTableMain').on('click','.moveTrashbutton',function(){ 
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            $('#deletedeleteForm').attr('action', '/admin/products/' + data[0]);
            $('#trashModal').modal('show');
        });
    });
// delete items end
</script>
@endsection