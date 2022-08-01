@extends('layouts.deliveryPerson')

@section('content')
    

    <div class="container-fluid dperson-dash-text mt-4">
        <h4> DELIVERIES</h4>
    </div>


    <div class="container-fluid ">

        <div class="order-details">
            <div class="row my-5">
                <div class="col">
                    <table class="table bg-white rounded shadow-sm  table-hover table-responsive-lg text-center" style="width: 70%; margin-left: 350px;">
                        <thead>
                            
                            <tr>
                                <th scope="col ">ORDER ID</th>
                                <th scope="col ">DELIVER ID</th>
                                {{-- <th scope="col ">Customer_Address</th> --}}
                                <th scope="col ">DELIVER STATUS </th>
                                <th scope="col">PAYMENT STATUS</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr>
                                <th scope="row"></th>
                                <td>Pasan</td>
                                {{-- <td>No:183/A Raigama Bandaragma</td> --}}
                                <td>

                                    <select class="form-select Dpstatus" aria-label="Default select example">
                                        <option  selected class="abc">Pending</option>
                                        <option value="2" >Delivered</option>
                                        <option value="3">Cancel</option>
                                    </select>
                                </td>
                                <td>Cash</td>
                                <td>
                                    <div class="correct">
                                        <button type="submit"><i class="fas fa-check-circle"></i></button> &nbsp;
                                        <a href="#"><i class="fas fa-trash-alt text-black"></i></a>
                                    </div>
                                   
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>

</body>
@endsection