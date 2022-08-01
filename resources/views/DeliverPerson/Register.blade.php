@extends('layouts.admin')

@section('title','DP-Register - ')
    
@section('content')
<div class="container-fluid col-lg-4 dash-text mt-4">
    <h4>REGISTER DELIVERY PERSON</h4>
</div><br>





<div class="container-fluid col-lg-5">

    <div class="orders">
        <div class="row my-5">
            <!-- <div class="col" > -->
            <form action="{{ route('admin.storeperson') }}" method="POST" autocomplete="off">
                @csrf
                @if (Session::get('fail'))
                <div class="alert alert-danger">
                    {{ Session::get('fail') }}
                </div>
                @endif 
                <div class="form-row">
                    <div class="">
                        <h5>ID</h5>
                        <input type="text" class="form-control  my-3 " name="id" value="{{ $maxid }}"  style="height: 50px;width: 800px;" readonly>
                    </div>
                </div>

                <div class="form-row">
                    <div class="">
                        <h5>FIRST NAME</h5>
                        <input type="text" class="form-control  my-3 " name="Firstname" value="{{ old('Firstname') }}"  style="height: 50px;width: 800px;">
                        <span class="text-danger">@error('Firstname'){{ $message }}@enderror</span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="">
                        <h5>LAST NAME</h5>
                        <input type="text" class="form-control  my-3 " name="Lastname" value="{{ old('Lastname') }}" style="height: 50px;width: 800px;">
                        <span class="text-danger">@error('Lastname'){{ $message }}@enderror</span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="">
                        <h5>EMAIL</h5>
                        <input type="email" class="form-control  my-3 " name="Email" value="{{ old('Email') }}" style="height: 50px;width: 800px;">
                        <span class="text-danger">@error('Email'){{ $message }}@enderror</span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="">
                        <h5>PASSWORD </h5>
                        <input type="password" class="form-control  my-3 " name="Password" value="{{ old('Password') }}" style="height: 50px;width: 800px;">
                        <span class="text-danger">@error('Password'){{ $message }}@enderror</span>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="">
                        <h5>CONFIRM PASSWORD</h5>
                        <input type="password" class="form-control  my-3 " name="Confirmpassword" value="{{ old('Confirmpassword') }}" style="height: 50px;width: 800px;">
                        <span class="text-danger">@error('Confirmpassword'){{ $message }}@enderror</span>
                    </div>
                </div>
                <div class="container col-lg-3">
                    <button type="submit" class="btn bg-dark editeproduct-btn" style="color: #fff;">Register</button>
                </div>

            </form>

        </div>


    </div>
</div><br>

@endsection