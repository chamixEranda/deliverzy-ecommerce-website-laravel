@extends('layouts.admin')

@section('title', 'DeliverPerson - ')
    
@section('content')
<div class="container col-lg-4 dash-text mt-4">
    <h1 style="font-weight: lighter">DELIVERY PERSON</h1>
</div><br>
<div class="container col-lg-5">
    <a href="{{ route('admin.createperson') }}"><button type="button" class="btn bg-dark product-btn"><i class="fas fa-plus-square"></i>  &nbsp; REGISTER NEW</button></a>
</div>

<div class="container-fluid col-lg-5">
    @if (Session::get('success'))
    <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                <table class="table bg-white rounded shadow-sm  table-hover table-responsive-lg product-tbl " id="deliveryPTableMain" style="width: 150%">
                    <thead>
                        <tr>
                            <th scope="col ">ID</th>
                            <th scope="col ">FIRST NAME</th>
                            <th scope="col ">LAST NAME</th>
                            <th scope="col ">EMAIL</th>
                            <th scope="col ">REGISTERED DATE</th>
                            <th scope="col">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($deliverperson as $oneperson)
                        <tr>
                            <th scope="row">{{ $oneperson->id }}</th> 
                            <td>{{ $oneperson->first_name }}</td>
                            <td>{{ $oneperson->last_name }}</td>
                            <td>{{ $oneperson->email }}</td>
                            <td>{{ $oneperson->created_at }}</td>
                            <td><a id="moveTrashbutton" class="moveTrashbutton btn-danger btn" href="#"><i class="bi bi-exclamation-circle-fill actionIcon"></i> Delete</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
    <script>
    // delete items
    $(document).ready(function (){
        $('#deliveryPTableMain').on('click','.moveTrashbutton',function(){ 
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            $('#deletedeleteForm').attr('action', '/admin/deliverperson/' + data[0]);
            $('#trashModal').modal('show');
        });
    });
// delete items end
</script>
@endsection